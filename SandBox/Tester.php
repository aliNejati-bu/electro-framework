<?php

declare(strict_types=1);

namespace Electro\SandBox;

use Electro\App\Abstraction\Config\ConfigServiceInterface;
use Electro\App\Exceptions\Config\ConfigNotFoundedException;
use Electro\Bootstrap\DicHandler;
use Whoops\Handler\PrettyPageHandler;

class Tester
{
    public static function main()
    {
        /*DIC()->get(ConfigServiceInterface::class)->addScope("app");
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(getContainer(ConfigServiceInterface::class)->getConfig("app","app_url"));
        var_dump(file_get_contents('php://input'));*/
        /*$clasa = (object) array(
            'e1' => array('nume' => 'Nitu', 'prenume' => 'Andrei', 'sex' => 'm', 'varsta' => 23),
            'e2' => array('nume' => 'Nae', 'prenume' => 'Ionel', 'sex' => 'm', 'varsta' => 27),
            'e3' => array('nume' => 'Noman', 'prenume' => 'Alice', 'sex' => 'f', 'varsta' => 22),
            'e4' => array('nume' => 'Geangos', 'prenume' => 'Bogdan', 'sex' => 'm', 'varsta' => 23),
            'e5' => array('nume' => 'Vasile', 'prenume' => 'Mihai', 'sex' => 'm', 'varsta' => 25)
        );
        var_dump($clasa);*/
    }
}
