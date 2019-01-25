<?php

namespace Skyree\SportsFixml\Strategy;

/**
 * Class RightDuplicateStrategy
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class RightDuplicateStrategy implements DuplicateStrategyInterface
{
    /**
     * @param \DOMNode $node
     * @return \DOMNode
     */
    public function getSibling(\DOMNode $node): ?\DOMNode
    {
        return $node->nextSibling;
    }
}
