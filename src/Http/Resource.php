<?php
namespace Procob\Http;

abstract class Resource
{
    protected static $api = null;

    public static function api()
    {
        if (is_null(static::$api)) {
            static::$api = new Api();
        }

        return static::$api;
    }

    public static function find(string $endpoint = null, $data = null, array $params = [])
    {
        return static::api()->get($endpoint, (string) $data, ['query' => $params]);
    }
}
