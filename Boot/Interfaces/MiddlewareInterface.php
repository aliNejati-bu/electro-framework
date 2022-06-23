<?php

namespace Electro\Boot\Interfaces;

interface MiddlewareInterface
{
    /**
     * @return mixed|null
     */
    public function run();
}