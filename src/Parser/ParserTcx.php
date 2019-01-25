<?php

namespace Skyree\SportsFixml\Parser;

/**
 * Class ParserTcx
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class ParserTcx extends AbstractParser
{
    /**
     * @param \DOMDocument $document
     * @return \DOMNodeList
     */
    protected function getWaypointNodes(\DOMDocument $document): \DOMNodeList
    {
        $xpath = parent::getXPath($document);
        return $xpath->query('ns:Activities/ns:Activity/ns:Lap/ns:Track/ns:Trackpoint');
    }

    /**
     * @param \DOMNode $node
     * @return string
     * @throws \RuntimeException
     */
    protected function getLatitude(\DOMNode $node): string
    {
        $xpath = parent::getXPath($node->ownerDocument);
        $latitudeNode = $xpath->query('ns:Position//ns:LatitudeDegrees', $node)->item(0);
        if (!($latitudeNode instanceof \DOMNode)) {
            throw new \RuntimeException('Bad tcx format: Missing "LatitudeDegrees" node');
        }
        return $latitudeNode->textContent;
    }

    /**
     * @param \DOMNode $node
     * @return string
     * @throws \RuntimeException
     */
    protected function getLongitude(\DOMNode $node): string
    {
        $xpath = parent::getXPath($node->ownerDocument);
        $longitudeNode = $xpath->query('ns:Position//ns:LongitudeDegrees', $node)->item(0);
        if (!($longitudeNode instanceof \DOMNode)) {
            throw new \RuntimeException('Bad tcx format: Missing "LongitudeDegrees" node');
        }
        return $longitudeNode->textContent;
    }
}
