<?php

namespace Electro\App\Abstraction\Server\Router;

use Electro\App\Abstraction\Server\MiddlewareCoreInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Exceptions\Server\ControllerMethodNotFound;
use Electro\App\Exceptions\Server\ControllerNotFoundException;
use Electro\App\Exceptions\Server\HandlerIsNotCallable;
use Electro\App\Exceptions\Server\ResponseLockedBeforeHandleController;

interface RouterInterface
{
    /**
     * @param ResponseInterface $response
     * @param RequestInterface $request
     * @param MiddlewareCoreInterface $middlewareCore
     */
    public function __construct(ResponseInterface $response, RequestInterface $request, MiddlewareCoreInterface $middlewareCore);

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param string $name
     * @param array $middlewares
     * @return RouterInterface
     * @throws ControllerNotFoundException
     * @throws ControllerMethodNotFound
     * @throws HandlerIsNotCallable
     * @throws ResponseLockedBeforeHandleController
     * for add get route
     */
    public function GET(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param string $name
     * @param array $middlewares
     * @return RouterInterface
     * @return RouterInterface
     * for add post route
     * @throws ControllerNotFoundException
     * @throws ControllerMethodNotFound
     * @throws HandlerIsNotCallable
     * @throws ResponseLockedBeforeHandleController
     */
    public function POST(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param string $name
     * @param array $middlewares
     * @return RouterInterface
     * @return RouterInterface
     * for add put route
     * @throws ControllerNotFoundException
     * @throws ControllerMethodNotFound
     * @throws HandlerIsNotCallable
     * @throws ResponseLockedBeforeHandleController
     */
    public function PUT(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param string $name
     * @param array $middlewares
     * @return RouterInterface
     * @return RouterInterface
     * for add patch route
     * @throws ControllerNotFoundException
     * @throws ControllerMethodNotFound
     * @throws HandlerIsNotCallable
     * @throws ResponseLockedBeforeHandleController
     */
    public function PATCH(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param string $name
     * @param array $middlewares
     * @return RouterInterface
     * @return RouterInterface
     * for add delete route
     * @throws ControllerNotFoundException
     * @throws ControllerMethodNotFound
     * @throws HandlerIsNotCallable
     * @throws ResponseLockedBeforeHandleController
     */
    public function DELETE(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * for run routing
     * @return void
     */
    public function run(): void;

    /**
     * @param string $prefix
     * @param array $middlewares
     * @param callable $handler
     * @return RouterInterface
     * for add prefix to group of routs.
     */
    public function group(string $prefix, callable $handler, array $middlewares = []): RouterInterface;


    /**
     * set namespace for controllers
     * @param string $namespace
     * @return RouterInterface
     */
    public function namespace(string $namespace): RouterInterface;

    /**
     * @param string $path
     * @param string[] $middlewares
     * @return RouterInterface
     */
    public function middleware(string $path, array $middlewares): RouterInterface;

    /**
     * @param array $middlewares
     * @return RouterInterface
     */
    public function addGlobalMiddleware(array $middlewares): RouterInterface;

    /**
     * @param callable|string $handler
     * @return RouterInterface
     */
    public function set404(callable|string $handler): RouterInterface;

}