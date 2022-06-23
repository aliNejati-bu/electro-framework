<?php

namespace RemoteConfig\Classes;

class Config
{

    /**
     * @var Config|null
     */
    public static Config|null $config = null;

    /**
     * @var array
     */
    private array $cachedViews = [];

    /**
     * base path for config
     * @param string $configPath
     */
    public function __construct(private string $configPath)
    {
    }

    /**
     * @param $name
     * @return array|bool
     */
    public function getAllConfig($name): array|bool
    {
        if (isset($this->cachedViews[$name])) {
            return $this->cachedViews[$name];
        }

        $configPath = $this->configPath . DIRECTORY_SEPARATOR . $name . ".php";
        if (!file_exists($configPath)) {
            return false;
        }

        $this->cachedViews[$name] = require $configPath;
        return $this->cachedViews[$name];
    }


    /**
     * @return Config
     */
    public static function getInstance(): Config
    {
        if (is_null(self::$config)) {
            self::$config = new self(BASE_DIR . DIRECTORY_SEPARATOR . "config");
        }
        return self::$config;
    }
}