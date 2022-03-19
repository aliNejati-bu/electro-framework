<?php

declare(strict_types=1);
namespace Electro\SandBox;
use DI\Container;
use Electro\App\Abstraction\Server\RequestInterface;

class Tester
{
    public static function main()
    {
        $di = new Container();
        echo RequestInterface::class;
        $di->set(app::class,\DI\autowire(app::class)->constructorParameter("app","reza"));

        $newDi = new Container();
        var_dump($newDi->get(app::class));
    }
}
