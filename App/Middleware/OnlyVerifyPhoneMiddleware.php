<?php

namespace RemoteConfig\App\Middleware;

use RemoteConfig\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run(): void
    {
        if (!auth()->userModel->isPhoneVerify()) {
            redirect(route("verifyPhone"))->exec();
        }
    }
}