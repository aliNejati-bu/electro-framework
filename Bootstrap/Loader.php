<?php

namespace Bootstrap;

use Electro\Bootstrap\DicHandler;

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
        self::loadDIC();
        require_once DicHandler::get("App_path") . DIRECTORY_SEPARATOR . "Helpers" . DIRECTORY_SEPARATOR . "helpers.php";
    }

    public static function loadDIC()
    {
        DicHandler::Register();
        // add app path to Container
        DicHandler::getContainer()->set("App_path", ELECTRO_BASE);
        DicHandler::addGroup(require_once ELECTRO_BASE . DIRECTORY_SEPARATOR . "Bootstrap" . DIRECTORY_SEPARATOR . "Providers" . DIRECTORY_SEPARATOR . "define.php");
    }
}