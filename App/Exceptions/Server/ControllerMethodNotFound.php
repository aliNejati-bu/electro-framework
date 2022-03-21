<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class ControllerMethodNotFound extends \Electro\App\Exceptions\BaseException
{
    public function __construct(string $class,$method)
    {
        parent::__construct(ExceptionStatus::NotFounded, "methode: {$class}->{$method} not founded.");
    }
}