<?php
namespace Procob\Helpers;

class Sanitizer
{
    // remove non numeric chars
    public static function cleanNumeric($value)
    {
        return preg_replace("/[^0-9]/", '', (string) $value);
    }

    // remove slash char
    public static function cleanString($value)
    {
        return preg_replace("/[\/]+/", '', (string) $value);
    }
}
?>
