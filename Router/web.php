<?php

use Phroute\Phroute\RouteCollector;
use RemoteConfig\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \RemoteConfig\App\Controller\IndexController::class);



$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \RemoteConfig\App\Controller\Admin\UserController::class
    );


});
