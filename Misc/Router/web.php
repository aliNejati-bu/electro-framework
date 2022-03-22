<?php

/**
 * @var RouterInterface $router
 */

// start routing

use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\Server\Router\RouterInterface;

$router->group("/app", function (RouterInterface $router) {
    $router->GET("/",function (RequestInterface $req,ResponseInterface $res){
       $res->send("در اپ");
    });
});
$router->GET("/",function (RequestInterface $req,ResponseInterface $res){

});
