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
        if ($res->isHtmlAccept()){
            $res->status(404)->send(view("Errors>e404", ["adr" => $req->getRequestUri()]));
        }else{
            $res->status(404)->send(["status"=>false,"massage"=>"route not found."]);
        }
    }
}