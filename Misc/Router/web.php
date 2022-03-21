<?php

/**
 * @var \Electro\App\Abstraction\Server\Router\RouterInterface $router
 */

// start routing

use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;

$router->GET("/",function (RequestInterface $req, ResponseInterface $res){
    $res->send(new \Electro\Providers\TemplateEngineService\TemplateEngineService("index",[],getContainer("App_path")));
});