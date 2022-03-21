<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class ControllerNotFoundException extends \Electro\App\Exceptions\BaseException
{
    public function __construct(string $controller)
    {
        parent::__construct(ExceptionStatus::NotFounded, "controller: {$controller} not founded.");
    }
}