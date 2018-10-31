<?php
namespace Procob\Http;

use Procob\Exceptions\ProcobParameterException;

class Procob
{
    const TIMEOUT                 = 'PROCOB_API_TIMEOUT';
    const USER                    = 'PROCOB_API_USER';
    const PWD                     = 'PROCOB_API_PWD';

    private static $apiUrl        = 'https://api.procob.com/consultas/';
    private static $timeout       = null;
    private static $user          = null;
    private static $pwd           = null;

    private static $defTimeout    = 30;
    private static $sdkVersion    = '1.0.1';

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

    public static function setUser(string $user = null)
    {
        static::$user = $user;

        if (static::$user === null) {
            static::$user = getenv(static::USER);
        }

        if (!strlen(static::$user)) {
            throw new ProcobParameterException("Missing required parameter '". static::USER ."'");
        }
    }

    public static function setPassword(string $pwd = null)
    {
        static::$pwd = $pwd;

        if (static::$pwd === null) {
            static::$pwd = getenv(static::PWD);
        }

        if (!strlen(static::$pwd)) {
            throw new ProcobParameterException("Missing required parameter '". static::PWD ."'");
        }
    }

    public static function getApiUrl()
    {
        return static::$apiUrl;
    }

    public static function getTimeout()
    {
        if (static::$timeout === null) {
            static::setTimeout();
        }

        return static::$timeout;
    }

    public static function getUser()
    {
        if (static::$user === null) {
            static::setUser();
        }

        return static::$user;
    }

    public static function getPassword()
    {
        if (static::$pwd === null) {
            static::setPassword();
        }

        return static::$pwd;
    }

    public static function getSdkVersion()
    {
        return static::$sdkVersion;
    }
}
