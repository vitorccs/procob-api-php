<?php

namespace Procob\Http;

use Procob\Exceptions\ProcobParameterException;

class Procob
{
    /**
     * The ENV name for Request Timeout parameter
     */
    const TIMEOUT = 'PROCOB_API_TIMEOUT';

    /**
     * The ENV name for API User parameter
     */
    const USER = 'PROCOB_API_USER';

    /**
     * The ENV name for API Password parameter
     */
    const PWD = 'PROCOB_API_PWD';

    /**
     * @var string
     */
    private static $apiUrl = 'https://api.procob.com/consultas/';

    /**
     * @var int|null
     */
    private static $timeout = null;

    /**
     * @var string|null
     */
    private static $user = null;

    /**
     * @var string|null
     */
    private static $pwd = null;

    /**
     * @var int
     */
    private static $defTimeout = 30;

    /**
     * @var string
     */
    private static $sdkVersion = '1.1.0';

    /**
     * @param array $params
     * @throws ProcobParameterException
     */
    public static function setParams(array $params)
    {
        if (isset($params[static::TIMEOUT])) {
            static::setTimeout($params[static::TIMEOUT]);
        }

        if (isset($params[static::USER])) {
            static::setUser($params[static::USER]);
        }

        if (isset($params[static::PWD])) {
            static::setPassword($params[static::PWD]);
        }
    }

    /**
     * @param int|null $seconds
     */
    public static function setTimeout(int $seconds = null)
    {
        static::$timeout = $seconds;

        if (static::$timeout === null) {
            static::$timeout = getenv(static::TIMEOUT);
        }

        if (!is_numeric(static::$timeout)) {
            static::$timeout = static::$defTimeout;
        }
    }

    /**
     * @param string|null $user
     * @throws ProcobParameterException
     */
    public static function setUser(string $user = null)
    {
        static::$user = $user;

        if (static::$user === null) {
            static::$user = getenv(static::USER);
        }

        if (!strlen(static::$user)) {
            throw new ProcobParameterException("Missing required parameter '" . static::USER . "'");
        }
    }

    /**
     * @param string|null $pwd
     * @throws ProcobParameterException
     */
    public static function setPassword(string $pwd = null)
    {
        static::$pwd = $pwd;

        if (static::$pwd === null) {
            static::$pwd = getenv(static::PWD);
        }

        if (!strlen(static::$pwd)) {
            throw new ProcobParameterException("Missing required parameter '" . static::PWD . "'");
        }
    }

    /**
     * @return string
     */
    public static function getApiUrl(): string
    {
        return static::$apiUrl;
    }

    /**
     * @return int
     */
    public static function getTimeout(): int
    {
        if (static::$timeout === null) {
            static::setTimeout();
        }

        return static::$timeout;
    }

    /**
     * @return string
     * @throws ProcobParameterException
     */
    public static function getUser(): string
    {
        if (static::$user === null) {
            static::setUser();
        }

        return static::$user;
    }

    /**
     * @return string
     * @throws ProcobParameterException
     */
    public static function getPassword(): string
    {
        if (static::$pwd === null) {
            static::setPassword();
        }

        return static::$pwd;
    }

    /**
     * @return string
     */
    public static function getSdkVersion(): string
    {
        return static::$sdkVersion;
    }
}
