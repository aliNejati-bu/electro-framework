<?php

namespace Electro\App\Middleware;

use Electro\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run(): void
    {
        if (!auth()->userModel->isPhoneVerify()) {
            redirect(route("verifyPhone"))->exec();
        }
    }
}