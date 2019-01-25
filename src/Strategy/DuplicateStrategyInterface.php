<?php

namespace Skyree\SportsFixml\Strategy;

/**
 * Interface DuplicateStrategyInterface
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
interface DuplicateStrategyInterface
{
    /**
     * @param \DOMNode $node
     * @return \DOMNode
     */
    public function getSibling(\DOMNode $node): ?\DOMNode;
}
