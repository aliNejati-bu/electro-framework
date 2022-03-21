<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Electro\App\Exceptions\BaseException;

class HandlerIsNotCallable extends BaseException
{
    public function __construct(string $controller)
    {
        parent::__construct(ExceptionStatus::Invalid, "Handler: {$controller} not callable.");
    }
}