<?php

interface ConfigServiceInterface
{
    /**
     * @param string $bassDirectory directory for config files
     */
    public function __construct(string $bassDirectory);

    /**
     * @param string $name name of file in config directory
     * @return bool if added true else false
     *
     */
    public function addScope(string $name):bool;

    /**
     * @param string $scope
     * @param string $name
     */
    public function getConfig(string $scope,string $name) :void;
}