<?php

namespace Electro\App\Middleware;

class Auth implements \Electro\Boot\Interfaces\MiddlewareInterface
{

    public function run()
    {
        request()->auth->doAuth();
    }
}