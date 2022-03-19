<?php

namespace Electro\App\Abstraction\Server\Router;

interface RouterInterface
{
    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * for add get route
     */
    public function GET(string $pattern, callable|string $handler, array $middlewares): void;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * for add post route
     */
    public function POST(string $pattern, callable|string $handler, array $middlewares): void;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * for add put route
     */
    public function PUT(string $pattern, callable|string $handler, array $middlewares): void;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * for add patch route
     */
    public function PATCH(string $pattern, callable|string $handler, array $middlewares): void;

    /**
     * @param string $pattern
     * @param callable|string $handler function (req,res)
     * @param array $middlewares
     * for add delete route
     */
    public function DELETE(string $pattern, callable|string $handler, array $middlewares): void;

    /**
     * for run routing
     * @return void
     */
    public function run(): void;

    /**
     * @param string $prefix
     * @param array $middlewares
     * @param callable $handler
     * for add prefix to group of routs.
     */
    public function group(string $prefix,array $middlewares,callable $handler): void;


    public function namespace(string $namespace):void;

}