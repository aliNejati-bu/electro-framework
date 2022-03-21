<?php

namespace Bootstrap;

use Electro\App\Abstraction\Config\ConfigServiceInterface;
use Electro\App\Abstraction\Server\ServerServiceInterface;
use Electro\Bootstrap\DicHandler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Loader
{
    public static function BOOT()
    {
        session_start();
        spl_autoload_register(function ($class) {
            $class = str_replace('Electro\\', "", $class);
            $file = ELECTRO_BASE . DIRECTORY_SEPARATOR .
                str_replace("\\", DIRECTORY_SEPARATOR, $class) . // replace \ in class namespace to DIRECTORY_SEPARATOR
                ".php";
            if (file_exists($file)) require_once $file;
        });
        /*
         * create DI and config
         */
        self::loadDIC();

        // add helpers
        require_once DicHandler::get("App_path") . DIRECTORY_SEPARATOR . "Helpers" . DIRECTORY_SEPARATOR . "helpers.php";

        // add app scope to config
        getContainer(ConfigServiceInterface::class)->addScope('app');

        self::addErrorReporter();

        getContainer(ServerServiceInterface::class)->start();

    }

    public static function loadDIC()
    {
        DicHandler::Register();
        // add app path to Container
        DicHandler::getContainer()->set("App_path", ELECTRO_BASE);
        DicHandler::addGroup(require_once ELECTRO_BASE . DIRECTORY_SEPARATOR . "Bootstrap" . DIRECTORY_SEPARATOR . "Providers" . DIRECTORY_SEPARATOR . "define.php");
    }

    public static function addErrorReporter()
    {
        /**
         * @var Run $errorHandler
         */
        $errorHandler = getContainer("errorReporter");
        $handler = new PrettyPageHandler();
        $handler->setEditor(getContainer(ConfigServiceInterface::class)->getConfig("app","editor"));
        if (!in_array('text/html',explode(",",$_SERVER["HTTP_ACCEPT"]))){
            $handler = new JsonResponseHandler();
        }
        $errorHandler->pushHandler($handler);
        $errorHandler->register();
    }
}