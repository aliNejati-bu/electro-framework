<?php

namespace Electro\App\Enums\Exceptions;

enum ExceptionStatus{
    case Duplicate;
    case Invalid;
    case NotFounded;
}