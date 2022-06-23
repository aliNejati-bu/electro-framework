<?php

use Phroute\Phroute\RouteCollector;
use Electro\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \Electro\App\Controller\IndexController::class);



$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \Electro\App\Controller\Admin\UserController::class
    );


});
