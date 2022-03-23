<?php

use Electro\App\Abstraction\Server\MiddlewareCoreInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\Server\Router\RouterInterface;
use Electro\App\Abstraction\Server\ServerServiceInterface;
use Electro\Bootstrap\DicHandler;
use Electro\Data\Abstraction\DataBaseInterface;
use Electro\Data\Abstraction\Repositories\UserRepositoryInterface;
use Electro\Data\MySQLDataBaseService\MySQLDatabase;
use Electro\Data\MySQLDataBaseService\Repositories\MySQLUserRepository;
use Electro\Server\Http\Middleware;
use Electro\Server\Http\Request;
use Electro\Server\Http\Response;
use Electro\Server\Router\ElectroRouterHandler;
use Electro\Server\ServerService;

return [

    // Config service
    \Electro\App\Abstraction\Config\ConfigServiceInterface::class => DI\create(
        \Electro\Providers\ConfigService\ElectroBasicConfigServiceProvider::class
    )->constructor(DicHandler::get("App_path") . DIRECTORY_SEPARATOR . "Config"),

    // error reporter class
    'errorReporter' => DI\create(\Whoops\Run::class),

    // add request and response to the dic
    ResponseInterface::class => DI\autowire(Response::class),
    RequestInterface::class => DI\autowire(Request::class),

    // middleware
    MiddlewareCoreInterface::class => DI\autowire(Middleware::class),

    // add router
    RouterInterface::class => DI\autowire(ElectroRouterHandler::class),

    ServerServiceInterface::class => DI\autowire(ServerService::class)->constructorParameter("projectRoot", DicHandler::get("App_path")),


    // database
    DataBaseInterface::class=>DI\autowire(MySQLDatabase::class),
    UserRepositoryInterface::class => DI\autowire(MySQLUserRepository::class),

];