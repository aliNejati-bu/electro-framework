<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \RemoteConfig\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \RemoteConfig\App\Middleware\AuthMiddleware::class,
        'apiAuthMiddleware' => \RemoteConfig\App\Middleware\ApiAuthMiddleware::class,
        'onlyVerifyPhone' => \RemoteConfig\App\Middleware\OnlyVerifyPhoneMiddleware::class,
    ]
];
