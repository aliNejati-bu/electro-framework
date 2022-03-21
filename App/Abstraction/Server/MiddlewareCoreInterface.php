<?php

namespace Electro\App\Abstraction\Server;

use Electro\App\Exceptions\Server\InvalidMiddlewareException;
use Electro\App\Exceptions\Server\MiddlewareNotFoundException;

interface MiddlewareCoreInterface
{
    /**
     * for register middleware
     * @param string $name
     * @param MiddlewareInterface $middleware
     * @throws InvalidMiddlewareException
     * @return void
     */
    public function RegisterMiddleWare(string $name, MiddlewareInterface $middleware): void;

    /**
     * @param array $middlewares for run middlewares
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     * @throws MiddlewareNotFoundException
     */
    public function runMiddleware(array $middlewares,RequestInterface $request,ResponseInterface $response): bool;

    /**
     * @param $name
     * @return MiddlewareInterface
     * @throws MiddlewareNotFoundException
     */
    public function getMiddlewareByName($name): MiddlewareInterface;


}