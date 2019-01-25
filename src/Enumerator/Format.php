<?php

namespace Skyree\SportsFixml\Enumerator;

/**
 * Class Format
 *
 * @author Skyree <boulakras.loic@gmail.com>
 */
class Format
{
    /** @var string */
    const FORMAT_TCX = 'tcx';

    /** @var string */
    const FORMAT_GPX = 'gpx';

    /** @var string[] */
    const ALLOWED_FORMATS = [
        self::FORMAT_TCX,
        self::FORMAT_GPX,
    ];
}
