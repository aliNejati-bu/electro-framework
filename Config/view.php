<?php


/*
 * view configs
 */
return [

    // base directory for views
    "baseViewDirectory" => BASE_DIR . DIRECTORY_SEPARATOR . "views",

    // default variables passed to views
    "default_variables" => [
        "base" => BASE_DIR . DIRECTORY_SEPARATOR . "views",
        "dirSep" => DIRECTORY_SEPARATOR,
        "url" => \RemoteConfig\Classes\Config::getInstance()->getAllConfig("app")["app_url"]
    ],
    "404" => "err>404"
];