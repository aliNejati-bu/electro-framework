<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class CanNotDoubleSendResponseException extends \Electro\App\Exceptions\BaseException
{
    public function __construct()
    {
        parent::__construct(ExceptionStatus::Invalid,"can not send response after send.");

    }
}