<?php

namespace Electro\App\Middleware;

use Electro\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run()
    {
        if (!auth()->userModel->isPhoneVerify()) {
            return redirect(route("verifyPhone"));
        }
        return true;
    }
}