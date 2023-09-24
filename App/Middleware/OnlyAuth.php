<?php

namespace Electro\App\Middleware;

class OnlyAuth implements \Electro\Boot\Interfaces\MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        if (!auth()->isAuth) {
            redirect(route('login'))->with('error', 'برای درسترسی به پنل باید وارد شده باشد.')->exec();
        }
    }
}