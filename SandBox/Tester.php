<?php

declare(strict_types=1);

namespace Electro\SandBox;

use Electro\App\Abstraction\Config\ConfigServiceInterface;
use Electro\Bootstrap\DicHandler;

class Tester
{
    public static function main()
    {
        DIC()->get(ConfigServiceInterface::class)->addScope("app");
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
    }
}
