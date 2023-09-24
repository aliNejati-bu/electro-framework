<?php


use Electro\App\Model\User;
use Electro\Classes\Validator\Rules;

return [
    'phone' => ['required', Rules::unique(User::class, 'phone')],
    'amount' => ['required', 'numeric'],
    'description' => ['string'],
    'type' => ['required', 'in:black,white'],
    'name' => ['required', 'string']
];