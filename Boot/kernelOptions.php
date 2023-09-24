<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \Electro\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \Electro\App\Middleware\AuthMiddleware::class,
        'apiAuthMiddleware' => \Electro\App\Middleware\ApiAuthMiddleware::class,
        'onlyVerifyPhone' => \Electro\App\Middleware\OnlyVerifyPhoneMiddleware::class,
        'auth' => \Electro\App\Middleware\Auth::class,
        'onlyAuth' => \Electro\App\Middleware\OnlyAuth::class,
    ]
];
