<?php
return [
    \Electro\App\Abstraction\Config\ConfigServiceInterface::class => DI\create(
        \Electro\Providers\ConfigService\ElectroBasicConfigServiceProvider::class
    )->constructor(\Electro\Bootstrap\DicHandler::get("App_path") . DIRECTORY_SEPARATOR . "Config"),
    'errorReporter' => DI\create(\Whoops\Run::class),
];