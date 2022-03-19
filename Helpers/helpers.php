<?php

use DI\DependencyException;
use DI\NotFoundException;
use JetBrains\PhpStorm\Pure;


# DIC helpers

#[Pure] function DIC(): DI\Container
{
    return \Electro\Bootstrap\DicHandler::getContainer();
}

/**
 * Returns an entry of the container by its name.
 *
 * @template T
 * @param string|class-string<T> $name Entry name or a class name.
 *
 * @return mixed|T
 * @throws NotFoundException No entry found for the given name.
 * @throws DependencyException Error while resolving the entry.
 */
function getContainer(string $name): mixed
{
    return DIC()->get($name);
}




# json
function isJson($string): bool
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

function convertToObject($array) {
    $object = new stdClass();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = convertToObject($value);
        }
        $object->$key = $value;
    }
    return $object;
}
