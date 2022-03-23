<?php

namespace Electro\Misc\Controller;

use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;

class MainController
{
    public function index(RequestInterface $req, ResponseInterface $res)
    {
        $res->send(view("welcome",[]));
    }

    public function notFoundError(RequestInterface $req, ResponseInterface $res)
    {
        $res->status(404)->send(view("Errors>e404",["adr"=>$req->getRequestUri()]));
    }
}