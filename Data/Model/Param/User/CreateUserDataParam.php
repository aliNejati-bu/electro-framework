<?php

namespace Electro\Data\Model\Param\User;

class CreateUserDataParam
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $username = null
    )
    {
    }
}