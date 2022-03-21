<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Electro\App\Exceptions\BaseException;

class InvalidMiddlewareException extends BaseException
{
    public function __construct(string $name)
    {
        parent::__construct(ExceptionStatus::Invalid,"Middleware: {$name} not valid.");
    }
}