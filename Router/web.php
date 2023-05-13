<?php

use Phroute\Phroute\RouteCollector;
use Electro\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->get("/",function (){
    return "index";
});
