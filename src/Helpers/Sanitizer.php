<?php

namespace Procob\Helpers;

class Sanitizer
{
    /**
     * Removes non numeric chars
     * @param $value
     * @return string|string[]|null
     */
    public static function cleanNumeric($value)
    {
        return preg_replace("/[^0-9]/", '', (string)$value);
    }

    /**
     * Removes slash char
     * @param $value
     * @return string|string[]|null
     */
    public static function cleanString($value)
    {
        return preg_replace("/[\/]+/", '', (string)$value);
    }
}
