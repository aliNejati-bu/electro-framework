<?php

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;
use RemoteConfig\Classes\Exception\ViewNotFoundedException;
use RemoteConfig\Classes\Redirect;
use RemoteConfig\Classes\ViewEngine;

class Boot
{
    private static array $kernelOptions = [];

    /**
     * @throws ViewNotFoundedException
     */
    public static function load()
    {
        self::generalBoot();
        self::BootDataBase();
        self::errorReporter();
        $router = new RouteCollector();

        date_default_timezone_set("Asia/Tehran");

        $router->filter("api", function () {
            header("Content-Type: application/json");
        });


        self::PrepareMiddlewares($router);


        $router->group(["prefix" => "/api", 'before' => 'api'], function (RouteCollector $router) {
            require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "api.php";

        });
        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "web.php";

        $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $exception) {
            if (isHtmlAccept()) {
                $response = view(get404ViewName());
            } else {
                $response = json_encode(["status" => false, "messages" => ["404 router not founded."]]);
                header("Content-Type: application/json");
            }
            http_response_code(404);
        }


        if ($response instanceof ViewEngine) {
            $response = $response->render();
        }

        if ($response instanceof Redirect) {
            $response->exec();
        }

        if (is_array($response)) {
            header("Content-Type: application/json");
            $response = json_encode($response);
        }

        echo $response;
    }

    public static function generalBoot()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace('RemoteConfig\\', "", $class);
            $file = BASE_DIR . DIRECTORY_SEPARATOR .
                str_replace("\\", DIRECTORY_SEPARATOR, $class) . // replace \ in class namespace to DIRECTORY_SEPARATOR
                ".php";
            if (file_exists($file)) require_once $file;
        });

        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Helpers" . DIRECTORY_SEPARATOR . "functions.php";
    }

    public static function BootDataBase()
    {

        $capsule = new Capsule;
        $dataBaseConfig = \RemoteConfig\Classes\Config::getInstance()->getAllConfig("database");
        $capsule->addConnection([

            "driver" => "mysql",

            "host" => $dataBaseConfig["server"],

            "database" => $dataBaseConfig["dbname"],

            "username" => $dataBaseConfig["username"],

            "password" => $dataBaseConfig["password"]

        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }

    public static function PrepareMiddlewares(RouteCollector $router)
    {
        // get kernel options if not set
        if (self::$kernelOptions == []) {
            self::$kernelOptions = require_once BASE_DIR . DIRECTORY_SEPARATOR . "Boot" . DIRECTORY_SEPARATOR . "kernelOptions.php";
        }

        $middlewares = self::$kernelOptions["middleware"];
        foreach ($middlewares as $name => $middleware) {
            $middlewareInstance = new $middleware;
            $router->filter($name, [$middlewareInstance, "run"]);
        }
    }

    public static function errorReporter()
    {
        $whoops = new \Whoops\Run;
        if (isHtmlAccept()) {
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        } else {
            $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
        }
        $whoops->register();
    }
}