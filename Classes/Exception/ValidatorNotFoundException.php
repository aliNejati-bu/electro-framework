<?php

namespace RemoteConfig\Classes\Exception;

use JetBrains\PhpStorm\Pure;
use Throwable;

class ValidatorNotFoundException extends \Exception
{
    /**
     * @param string $viewName
     * @param int $code
     * @param Throwable|null $previous
     */
    #[Pure] public function __construct(string $viewName, $code = 0, Throwable $previous = null)
    {
        parent::__construct("validator $viewName is not founded.", $code, $previous);
    }
}