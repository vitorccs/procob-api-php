<?php
namespace Procob\Http;

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
    private static $defUser       = 'sandbox@procob.com';
    private static $defPwd        = 'TesteApi';
    private static $sdkVersion    = "1.0.0";

    public static function setTimeout(int $seconds = null)
    {
        static::$timeout = $seconds;

        if (static::$timeout === null) {
            static::$timeout = getenv(static::TIMEOUT);
        }

        if (static::$timeout === false) {
            static::$timeout = static::$defTimeout;
        }
    }

    public static function setUser(string $user = null)
    {
        static::$user = $user;

        if (static::$user === null) {
            static::$user = getenv(static::USER);
        }

        if (static::$user === false) {
            static::$user = static::$defUser;
        }
    }

    public static function setPassword(string $pwd = null)
    {
        static::$pwd = $pwd;

        if (static::$pwd === null) {
            static::$pwd = getenv(static::PWD);
        }

        if (static::$pwd === false) {
            static::$pwd = static::$defPwd;
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
