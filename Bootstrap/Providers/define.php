<?php

use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;

return [

    // Config service
    \Electro\App\Abstraction\Config\ConfigServiceInterface::class => DI\create(
        \Electro\Providers\ConfigService\ElectroBasicConfigServiceProvider::class
    )->constructor(\Electro\Bootstrap\DicHandler::get("App_path") . DIRECTORY_SEPARATOR . "Config"),

    // error reporter class
    'errorReporter' => DI\create(\Whoops\Run::class),

    // add request and response to the dic
    ResponseInterface::class => DI\autowire(\Electro\Server\Http\Response::class),
    RequestInterface::class => DI\autowire(\Electro\Server\Http\Request::class),

    // middleware
    \Electro\App\Abstraction\Server\MiddlewareCoreInterface::class => DI\autowire(\Electro\Server\Http\Middleware::class),

    // add router
    \Electro\App\Abstraction\Server\Router\RouterInterface::class => DI\autowire(\Electro\Server\Router\ElectroRouterHandler::class),

    \Electro\App\Abstraction\Server\ServerServiceInterface::class => DI\autowire(\Electro\Server\ServerService::class)->constructorParameter("projectRoot",\Electro\Bootstrap\DicHandler::get("App_path"))
];