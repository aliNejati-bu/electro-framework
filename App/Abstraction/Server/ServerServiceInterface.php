<?php

namespace Electro\App\Abstraction\Server;

use Electro\App\Abstraction\Server\Router\RouterInterface;

interface ServerServiceInterface
{

    /**
     * @param RouterInterface $router
     * @param RequestInterface $request
     * @param MiddlewareCoreInterface $middlewareCore
     */
    public function __construct(RouterInterface $router, RequestInterface $request, ResponseInterface $response, MiddlewareCoreInterface $middlewareCore, string $projectRoot);

    /**
     * @return mixed
     */
    public function start(): void;
}