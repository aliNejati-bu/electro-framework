<?php

namespace Electro\App\Exceptions\Server;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Electro\App\Exceptions\BaseException;

class ResponseLockedBeforeHandleController extends BaseException
{
    public function __construct()
    {
        parent::__construct(ExceptionStatus::Invalid,"Response Are sent.");
    }
}