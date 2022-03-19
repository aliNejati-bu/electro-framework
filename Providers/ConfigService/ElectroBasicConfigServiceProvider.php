<?php

declare(strict_types=1);
namespace Electro\Providers\ConfigService;

use Electro\App\Abstraction\Config\ConfigServiceInterface;
use Electro\App\Exceptions\Config\ConfigNotFoundedException;
use Electro\App\Exceptions\Config\InvalidConfigScopeException;

class ElectroBasicConfigServiceProvider implements ConfigServiceInterface
{
    /**
     * @var string for save base path for configs
     */
    private string $path;


    /**
     * @var array scopes are registered.
     */
    private array $scopes = [];


    /**
     * @var array loaded configs saved in this variable for don't repeat load a Config.
     */
    private array $loaded = [];


    /**
     * @inheritDoc
     */
    public function __construct(string $bassDirectory)
    {
        $this->path = $bassDirectory;
    }

    /**
     * @inheritDoc
     */
    public function addScope(string $name, string $newPath = null): bool
    {
        $path = $this->path;
        if (!is_null($newPath)) {
            $path = $newPath;
        }

        if (str_contains($name, '_')) {
            throw new InvalidConfigScopeException($name);
        }
        if (file_exists($path . DIRECTORY_SEPARATOR . $name . ".config.php")) {

            $this->scopes[$name] = $path . DIRECTORY_SEPARATOR . $name . ".config.php";
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getConfig(string $scope, string $name): string
    {
        if (isset($this->scopes[$scope])) {
            if (!isset($this->loaded[$scope])){
                $this->loaded[$scope] = require_once $this->scopes[$scope];
            }
            if (isset($this->loaded[$scope][$name])){
                return $this->loaded[$scope][$name];
            }else{
                throw new ConfigNotFoundedException("{$scope}_{$name}");
            }
        } else {
            throw new ConfigNotFoundedException("{$scope}_{$name}");
        }
    }
}