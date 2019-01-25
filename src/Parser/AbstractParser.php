<?php

namespace Skyree\SportsFixml\Parser;

use Skyree\SportsFixml\Strategy\DuplicateStrategyInterface;

/**
 * Class AbstractParser
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
abstract class AbstractParser implements ParserInterface
{
    /** @var DuplicateStrategyInterface */
    private $strategy;

    /**
     * AbstractParser constructor.
     *
     * @param DuplicateStrategyInterface $strategy
     */
    public function __construct(DuplicateStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param \DOMDocument $document
     * @return int
     * @throws \RuntimeException
     */
    public function removeDuplicates(\DOMDocument $document): int
    {
        $removedNodes = 0;

        $waypointNodes = $this->getWaypointNodes($document);

        /** @var \DOMNode $waypointNode */
        foreach ($waypointNodes as $waypointNode) {
            $waypointNodeHash = $this->getWaypointHash($waypointNode);

            $sibling = $this->strategy->getSibling($waypointNode);
            if ($sibling instanceof \DOMNode && $waypointNodeHash === $this->getWaypointHash($sibling)) {
                $removedNodes++;
                $waypointNode->parentNode->removeChild($waypointNode);
            }
        }

        return $removedNodes;
    }

    /**
     * @param \DOMNode $waypointNode
     * @return string
     * @throws \RuntimeException
     */
    private function getWaypointHash(\DOMNode $waypointNode): string
    {
        return md5($this->getLatitude($waypointNode) . '|' . $this->getLongitude($waypointNode));
    }

    /**
     * @param \DOMDocument $document
     * @return \DOMXPath
     */
    protected function getXPath(\DOMDocument $document): \DOMXPath
    {
        $namespace = $document->documentElement->namespaceURI;
        $xpath = new \DOMXPath($document);

        if (is_null($namespace)) {
            throw new \RuntimeException('Document should have a namespace');
        }

        $xpath->registerNamespace('ns', $namespace);

        return $xpath;
    }

    /**
     * @param \DOMDocument $document
     * @return \DOMNodeList
     */
    abstract protected function getWaypointNodes(\DOMDocument $document): \DOMNodeList;

    /**
     * @param \DOMNode $xmlNode
     * @return string
     * @throws \RuntimeException
     */
    abstract protected function getLatitude(\DOMNode $xmlNode): string;

    /**
     * @param \DOMNode $xmlNode
     * @return string
     * @throws \RuntimeException
     */
    abstract protected function getLongitude(\DOMNode $xmlNode): string;
}
