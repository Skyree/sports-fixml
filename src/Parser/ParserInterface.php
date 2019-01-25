<?php

namespace Skyree\SportsFixml\Parser;

/**
 * Interface ParserInterface
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
interface ParserInterface
{
    /**
     * @param \DOMDocument $document
     * @return int
     */
    public function removeDuplicates(\DOMDocument $document): int;
}
