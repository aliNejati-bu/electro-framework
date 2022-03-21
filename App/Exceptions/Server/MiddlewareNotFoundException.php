<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class MiddlewareNotFoundException extends \Electro\App\Exceptions\BaseException
{
    public function __construct(string $name)
    {
        parent::__construct(ExceptionStatus::NotFounded,"Middleware: {$name} not founded");
    }
}