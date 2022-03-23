<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;

class FileNotExistsException extends \Electro\App\Exceptions\BaseException
{
    public function __construct(string $name)
    {
        parent::__construct(ExceptionStatus::Invalid, "File: {$name} not exists.");
    }
}