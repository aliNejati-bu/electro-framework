<?php

namespace Electro\App\Exceptions\TemplateEngine;

use Electro\App\Enums\Exceptions\ExceptionStatus;

class ViewNotExistException extends \Electro\App\Exceptions\BaseException
{
    public function __construct(string $path)
    {
        parent::__construct(ExceptionStatus::NotFounded, "view: {$path} not founded.");
    }
}