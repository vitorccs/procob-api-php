<?php
namespace Procob\Http;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\TransferStats;

class Client extends Guzzle
{
    protected $fullUrl;
    protected $certKey;
    protected $privateKey;

    public function __construct(array $config = [])
    {
        $this->setConfig($config);

        parent::__construct($config);
    }

    public function setConfig(array &$config)
    {
        $sdkVersion = Procob::getSdkVersion();
        $host       = $_SERVER['HTTP_HOST'] ?? '';
        $url        = &$this->fullUrl;

        $config = array_merge([
            'verify'        => false,
            'base_uri'      => Procob::getApiUrl(),
            'timeout'       => Procob::getTimeout(),
            'on_stats'      => function (TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri();
            },
            'headers'       => [
                'Authorization'     => 'Basic '. $this->getCredentials(),
                'Content-Type'      => 'application/json',
                'User-Agent'        => "Procob-API-PHP/{$sdkVersion};{$host}"
            ]
        ], $config);

        return $config;
    }

    public function getFullUrl()
    {
        return $this->fullUrl;
    }

    public function getCredentials()
    {
        $username = Procob::getUser();
        $password = Procob::getPassword();

        return base64_encode("{$username}:{$password}");
    }
}
