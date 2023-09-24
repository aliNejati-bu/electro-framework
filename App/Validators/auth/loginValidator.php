<?php

use Electro\App\Model\User;
use Electro\Classes\Validator\Rules;

return [
    "phone" => ['required', 'min:10','max:11'],
    "password" => ['required'],
    "isLong" => ["default:0"]
];