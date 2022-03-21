<?php

namespace Electro\Server\Router;

use Electro\App\Abstraction\Server\Router\RouterInterface;

class ElectroRouterHandler implements \Electro\App\Abstraction\Server\Router\RouterInterface
{


    /**
     * @var array get handlers poll
     */
    private array $_getHandlers = [];

    /**
     * @var array post handlers poll
     */
    private array $_postHandlers = [];


    /**
     * @var array put handlers poll
     */
    private array $_putHandlers = [];

    /**
     * @var array patch handlers poll
     */
    private array $_patchHandlers = [];


    /**
     * @var array delete handlers poll
     */
    private array $_deleteHandlers = [];

    /**
     * @var array for cache controller instance
     */
    private array $_controllerInstanceCache = [];


    /**
     * @var string for sor prefix of routes
     */
    private string $_prefix = "";

    /**
     * @var string[]
     */
    private array $globalMiddlewares = [];

    /**
     * @inheritDoc
     */
    public function GET(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

    }

    /**
     * @inheritDoc
     */
    public function POST(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {
        // TODO: Implement POST() method.
    }

    /**
     * @inheritDoc
     */
    public function PUT(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {
        // TODO: Implement PUT() method.
    }

    /**
     * @inheritDoc
     */
    public function PATCH(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {
        // TODO: Implement PATCH() method.
    }

    /**
     * @inheritDoc
     */
    public function DELETE(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {
        // TODO: Implement DELETE() method.
    }

    /**
     * @inheritDoc
     */
    public function run(): void
    {
        // TODO: Implement run() method.
    }

    /**
     * @inheritDoc
     */
    public function group(string $prefix, callable $handler, array $middlewares = []): RouterInterface
    {
        // TODO: Implement group() method.
    }

    /**
     * @inheritDoc
     */
    public function namespace(string $namespace): RouterInterface
    {
        // TODO: Implement namespace() method.
    }

    /**
     * @inheritDoc
     */
    public function middleware(string $path, array|string $middlewares): RouterInterface
    {
        // TODO: Implement middleware() method.
    }
}