<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class HeadersHasSentException extends \Electro\App\Exceptions\BaseException
{
    public function __construct()
    {
        parent::__construct(ExceptionStatus::Invalid,"can not set header.");
    }
}