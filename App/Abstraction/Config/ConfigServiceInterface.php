<?php

namespace Electro\App\Abstraction\Config;

use Electro\App\Exceptions\Config\ConfigNotFoundedException;
use Electro\App\Exceptions\Config\InvalidConfigScopeException;

interface ConfigServiceInterface
{
    /**
     * @param string $bassDirectory directory for Config files
     */
    public function __construct(string $bassDirectory);

    /**
     * @param string $name name of file in Config directory
     * @return bool if added true else false
     * @throws InvalidConfigScopeException
     * scope cant not include '_'
     *
     */
    public function addScope(string $name): bool;

    /**
     * @param string $scope
     * @param string $name
     * @throws ConfigNotFoundedException
     */
    public function getConfig(string $scope, string $name): string;
}