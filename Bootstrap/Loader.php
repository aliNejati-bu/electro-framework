<?php

namespace Bootstrap;

class Loader
{
    public static function BOOT()
    {
        spl_autoload_register(function ($class){
            $class = str_replace('Electro\\',"",$class);
            $file = ELECTRO_BASE . DIRECTORY_SEPARATOR .
                str_replace("\\",DIRECTORY_SEPARATOR,$class). // replace \ in class namespace to DIRECTORY_SEPARATOR
                ".php";
            require_once $file; // include if file exists.
        });
    }
}