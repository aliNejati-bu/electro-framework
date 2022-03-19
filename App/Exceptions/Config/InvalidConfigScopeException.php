<?php
declare(strict_types=1);
namespace Electro\App\Exceptions\Config;

use Electro\App\Enums\Exceptions\ExceptionStatus;
use Electro\App\Exceptions\BaseException;

class InvalidConfigScopeException extends BaseException
{
    public function __construct(string $name)
    {
        parent::__construct(ExceptionStatus::Invalid,"invalid config scope : {$name}");
    }
}