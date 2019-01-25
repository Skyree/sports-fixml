<?php

namespace Skyree\SportsFixml\Parser;

/**
 * Class ParserGpx
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class ParserGpx extends AbstractParser
{
    /**
     * @param \DOMDocument $document
     * @return \DOMNodeList
     */
    protected function getWaypointNodes(\DOMDocument $document): \DOMNodeList
    {
        $xpath = parent::getXPath($document);
        return $xpath->query('ns:trk/ns:trkseg/ns:trkpt');
    }

    /**
     * @param \DOMNode $node
     * @return string
     */
    protected function getLatitude(\DOMNode $node): string
    {
        $latitudeNode = $node->attributes->getNamedItem('lat');
        if (!($latitudeNode instanceof \DOMNode)) {
            throw new \RuntimeException('Bad gpx format: Missing "lat" attribute');
        }
        return $latitudeNode->textContent;
    }

    /**
     * @param \DOMNode $node
     * @return string
     */
    protected function getLongitude(\DOMNode $node): string
    {
        $longitudeNode = $node->attributes->getNamedItem('lon');
        if (!($longitudeNode instanceof \DOMNode)) {
            throw new \RuntimeException('Bad gpx format: Missing "lon" attribute');
        }
        return $longitudeNode->textContent;
    }
}
