<?php
namespace Procob\Http;

use GuzzleHttp\Exception\GuzzleException;
use Procob\Exceptions\ProcobApiException;
use Procob\Exceptions\ProcobRequestException;

abstract class Resource
{
    /**
     * @var Api|null
     */
    protected static $api = null;

    /**
     * @return Api|null
     */
    public static function api()
    {
        if (is_null(static::$api)) {
            static::$api = new Api();
        }

        return static::$api;
    }

    /**
     * @param string|null $endpoint
     * @param mixed $data
     * @param array $params
     * @return mixed
     * @throws GuzzleException
     * @throws ProcobApiException
     * @throws ProcobRequestException
     */
    public static function find(string $endpoint = null, $data = null, array $params = [])
    {
        return static::api()->get($endpoint, (string) $data, ['query' => $params]);
    }
}
