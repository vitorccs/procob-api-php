<?php

namespace Procob\Helpers;

class SanitizerHelper
{
    /**
     * Removes non-numeric chars
     *
     * @param $value
     * @return string
     */
    public static function cleanNumeric($value): string
    {
        return preg_replace("/[^0-9]/", '', (string)$value);
    }

    /**
     * Remove slash char from value, so it can be safely used as URL parameter
     *
     * NOTE: This sanitization is required because all Procob API's requests
     * are GET method and payload must be sent via URL parameter
     * (e.g: /endpoint/{id}, /endpoint/{name})
     *
     * @param $value
     * @return string
     */
    public static function cleanString($value): string
    {
        return preg_replace("/[\/]+/", '', (string)$value);
    }
}
