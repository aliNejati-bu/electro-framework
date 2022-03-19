<?php

namespace Electro\App\Exceptions\Config;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Electro\App\Exceptions\BaseException;

class ConfigNotFoundedException extends BaseException
{
    public function __construct(string $name)
    {
        parent::__construct(ExceptionStatus::NotFounded,"config not founded : {$name}");
    }
}