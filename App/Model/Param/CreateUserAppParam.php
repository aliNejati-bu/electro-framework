<?php

namespace Electro\App\Model\Param;

class CreateUserAppParam
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $username = null,
    )
    {
    }
}