<?php

namespace Electro\Bootstrap;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

class DicHandler
{
    private static Container $_container;

    public static function Register()
    {
        self::$_container = new Container();
    }

    /**
     * @return Container
     */
    public static function getContainer(): Container
    {
        return self::$_container;
    }

    public static function addGroup(array $injections)
    {
        foreach ($injections as $name=>$injection){
            self::$_container->set($name,$injection);
        }
    }

    /**
     * Returns an entry of the container by its name.
     *
     * @template T
     * @param string|class-string<T> $name Entry name or a class name.
     *
     * @throws DependencyException Error while resolving the entry.
     * @throws NotFoundException No entry found for the given name.
     * @return mixed|T
     */
    public static function get(string $name): mixed
    {
        return self::$_container->get($name);
    }


}