<?php

namespace Electro\App\Abstraction\Server;

interface MiddlewareInterface
{
    public function run(RequestInterface $req, ResponseInterface $res): bool;
}