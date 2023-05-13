<?php


use Electro\Extra\Router;
use Illuminate\Database\Capsule\Manager as Capsule;
use Electro\Classes\Exception\ViewNotFoundedException;
use Electro\Classes\Redirect;
use Electro\Classes\ViewEngine;

class Boot
{
    public static Router $router;
    private static array $kernelOptions = [];

    /**
     * @throws ViewNotFoundedException
     */
    public static function load()
    {
        self::generalBoot();
        self::BootDataBase();
        self::errorReporter();
        $router = new Router();

        self::$router = $router;

        $router->group('/api', function (Router $router) {
            require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "api.php";
        },
            [
                function () {
                    header("Content-Type: application/json");
                    return true;
                }
            ]
        );

        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "web.php";

        $router->set404(function () {
            http_response_code(404);
            if (isHtmlAccept()) {
                return view(get404ViewName());
            } else {
                header("Content-Type: application/json");
                return json_encode(["status" => false, "messages" => ["404 router not founded."]]);
            }
        });

        $response = $router->run($_SERVER['REQUEST_URI'], $_SERVER["REQUEST_METHOD"]);


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
            $class = str_replace('Electro\\', "", $class);
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
        $dataBaseConfig = \Electro\Classes\Config::getInstance()->getAllConfig("database");
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