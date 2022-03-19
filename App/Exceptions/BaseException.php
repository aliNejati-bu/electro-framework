<?php

namespace Electro\App\Exceptions;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Throwable;

class BaseException extends \Exception
{
    public function __construct(public ExceptionStatus $status,
                                string                 $message,
                                int                    $code = 0,
                                Throwable              $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}