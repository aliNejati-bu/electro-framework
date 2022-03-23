<?php

namespace Electro\Data\Exceptions;

use JetBrains\PhpStorm\Pure;
use Throwable;

class BaseDataException extends \Exception
{

    public Throwable $originalError;

    #[Pure] public function __construct(Throwable $originalError)
    {
        $this->originalError = $originalError;
        parent::__construct("data base un handled exception!");
    }
}