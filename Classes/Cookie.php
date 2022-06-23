<?php

namespace RemoteConfig\Classes;

class Cookie
{


    /**
     * @var Cookie|null
     */
    public static ?Cookie $cookie = null;

    /**
     * @param string $cookieName
     * @param mixed $cookieData
     * @param string $expireTime
     * @param bool $httpOnly
     * @param string $path
     * @param string $domain
     * @return bool
     */
    public function setCookie(string $cookieName, mixed $cookieData, string $expireTime, bool $httpOnly = true, string $path = "", string $domain = ""): bool
    {
        return setcookie($cookieName, $cookieData, $expireTime, $path, $domain, false, $httpOnly);
    }


    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getCookie(string $name, mixed $default): mixed
    {
        return $_COOKIE[$name] ?? $default;
    }

    /**
     * @return Cookie
     */
    public static function getInstance(): Cookie
    {
        if (self::$cookie == null) {
            self::$cookie = new  self();
        }
        return self::$cookie;
    }
}