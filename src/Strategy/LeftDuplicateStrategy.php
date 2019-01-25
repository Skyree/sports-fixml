<?php

namespace Skyree\SportsFixml\Strategy;

/**
 * Class LeftDuplicateStrategy
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class LeftDuplicateStrategy implements DuplicateStrategyInterface
{
    /**
     * @param \DOMNode $node
     * @return \DOMNode
     */
    public function getSibling(\DOMNode $node): ?\DOMNode
    {
        return $node->previousSibling;
    }
}
