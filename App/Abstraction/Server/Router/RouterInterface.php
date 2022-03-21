<?php

namespace Electro\App\Abstraction\Server\Router;

interface RouterInterface
{
    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * @return RouterInterface
     * for add get route
     */
    public function GET(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * @return RouterInterface
     * for add post route
     */
    public function POST(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * @return RouterInterface
     * for add put route
     */
    public function PUT(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * @return RouterInterface
     * for add patch route
     */
    public function PATCH(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * @return RouterInterface
     * for add delete route
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
     * @param string[]|string $middlewares
     * @return RouterInterface
     */
    public function middleware(string $path, array|string $middlewares): RouterInterface;

}