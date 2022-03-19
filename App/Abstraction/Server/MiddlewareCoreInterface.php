<?php

namespace Electro\App\Abstraction\Server;

interface MiddlewareCoreInterface
{
    public function runMiddleware(array $middlewares):void;
}