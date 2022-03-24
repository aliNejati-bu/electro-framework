<?php

/**
 * @var RouterInterface $router
 */

// start routing

use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\Server\Router\RouterInterface;

$router->set404("MainController@notFoundError");

$router->GET("/","MainController@index");

$router->POST("/test",function (RequestInterface $req,ResponseInterface $res){
    var_dump($req->files()["app"]->copy("app"));
});