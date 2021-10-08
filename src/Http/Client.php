<?php
namespace Procob\Http;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\TransferStats;
use Procob\Exceptions\ProcobParameterException;

class Client extends Guzzle
{
    /**
     * @var string|null
     */
    protected $fullUrl;

    /**
     * @param array $config
     * @throws ProcobParameterException
     */
    public function __construct(array $config = [])
    {
        $this->setConfig($config);

        parent::__construct($config);
    }

    /**
     * @param array $config
     * @return array
     * @throws ProcobParameterException
     */
    public function setConfig(array &$config): array
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

    /**
     * @return string|null
     */
    public function getFullUrl(): ?string
    {
        return $this->fullUrl;
    }

    /**
     * @return string
     * @throws ProcobParameterException
     */
    public function getCredentials(): string
    {
        $username = Procob::getUser();
        $password = Procob::getPassword();

        return base64_encode("{$username}:{$password}");
    }
}
