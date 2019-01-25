<?php

namespace Skyree\SportsFixml;

use Skyree\SportsFixml\Enumerator\Format;
use Skyree\SportsFixml\Parser\ParserFactory;
use Skyree\SportsFixml\Parser\ParserInterface;

/**
 * Class Fixer
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class Fixer
{
    /** @var ParserFactory */
    private $parserFactory;

    /** @var string */
    private $strategy;

    /**
     * Fixer constructor.
     *
     * @param ParserFactory $parserFactory
     * @param string $strategy
     */
    public function __construct(ParserFactory $parserFactory, string $strategy)
    {
        $this->parserFactory = $parserFactory;
        $this->strategy = $strategy;
    }

    /**
     * @param string $directory
     * @return array
     */
    public function fix(string $directory): array
    {
        $report = [
            'error' => [],
            'success' => []
        ];

        $iterator = new \DirectoryIterator($directory);

        foreach ($iterator as $item) {
            if ($item->isDir() || !in_array($item->getExtension(), Format::ALLOWED_FORMATS)) {
                continue;
            }

            $parser = $this->parserFactory::create($item->getExtension(), $this->strategy);

            try {
                $removedNodes = $this->processFile($parser, $item);
                $report['success'][$item->getBasename()] = $removedNodes;
            } catch (\Exception $exception) {
                $report['error'][$item->getBasename()] = $exception->getMessage();
            }
        }

        return $report;
    }

    /**
     * @param ParserInterface $parser
     * @param \DirectoryIterator $item
     * @return int
     */
    private function processFile(ParserInterface $parser, \DirectoryIterator $item): int
    {
        $document = new \DOMDocument();
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;
        $document->load($item->getRealPath());

        $removedNodes = $parser->removeDuplicates($document);
        $this->saveFile($item, $document);

        return $removedNodes;
    }

    /**
     * @param \DirectoryIterator $item
     * @param \DOMDocument $document
     */
    private function saveFile(\DirectoryIterator $item, \DOMDocument $document): void
    {
        $path = $item->getPath() . '/fixed';
        if (!file_exists($path)) {
            mkdir($path);
        }

        $filePath = $path . '/' . $item->getBasename();
        $document->save($filePath);
    }
}
