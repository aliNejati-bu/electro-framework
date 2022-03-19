<?php

declare(strict_types=1);

namespace Electro\SandBox;

use Electro\App\Abstraction\Config\ConfigServiceInterface;
use Electro\Bootstrap\DicHandler;

class Tester
{
    public static function main()
    {
        DicHandler::get(ConfigServiceInterface::class)->addScope("app");
        var_dump(DicHandler::get(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(DicHandler::get(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(DicHandler::get(ConfigServiceInterface::class)->getConfig("app","app_url"));
    }
}
