<?php

namespace RemoteConfig\Boot\Interfaces;

interface MiddlewareInterface
{
    /**
     * @return mixed|null
     */
    public function run();
}