<?php

namespace Skyree\SportsFixml\Parser;

use Skyree\SportsFixml\Enumerator;
use Skyree\SportsFixml\Strategy;

/**
 * Class ParserFactory
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class ParserFactory
{
    /**
     * @param string $extension
     * @param string $strategy
     * @return ParserInterface
     */
    public static function create(string $extension, string $strategy): ParserInterface
    {
        $duplicateStrategy = self::getStrategy($strategy);

        switch ($extension) {
            case Enumerator\Format::FORMAT_TCX:
                return new ParserTcx($duplicateStrategy);
                break;
            case Enumerator\Format::FORMAT_GPX:
                return new ParserGpx($duplicateStrategy);
                break;
            default:
                throw new \RuntimeException('Unsupported format');
        }
    }

    /**
     * @param string $strategy
     * @return Strategy\DuplicateStrategyInterface
     */
    private static function getStrategy(string $strategy): Strategy\DuplicateStrategyInterface
    {
        switch ($strategy) {
            case Enumerator\Strategy::RIGHT:
                return new Strategy\RightDuplicateStrategy();
            case Enumerator\Strategy::LEFT:
            default:
                return new Strategy\LeftDuplicateStrategy();
        }
    }
}
