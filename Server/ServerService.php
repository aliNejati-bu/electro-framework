<?php

namespace Electro\Server;

use Electro\App\Abstraction\Server\MiddlewareCoreInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\Server\Router\RouterInterface;

class ServerService implements \Electro\App\Abstraction\Server\ServerServiceInterface
{

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    private MiddlewareCoreInterface $middlewareCore;

    private array $misc = [];


    /**
     * @var string
     */
    private string $projectRoot = "";

    /**
     * @inheritDoc
     */
    public function __construct(RouterInterface $router, RequestInterface $request, ResponseInterface $response, MiddlewareCoreInterface $middlewareCore, string $projectRoot)
    {
        $this->response = $response;
        $this->request = $request;
        $this->middlewareCore = $middlewareCore;
        $this->router = $router;
        $this->projectRoot = $projectRoot;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {

        // get list of middlewares
        $this->misc = require_once $this->projectRoot . DIRECTORY_SEPARATOR . "Misc" . DIRECTORY_SEPARATOR . "addToKernel.php";

        // register middlewares
        foreach ($this->misc['middlewares'] as $name => $value) {
            $this->middlewareCore->RegisterMiddleWare($name, $value);
        }

        // create helper variable for router file
        $router = $this->router;

        $router->namespace("Electro\Misc\Controller");

        // load router file
        require_once $this->projectRoot . DIRECTORY_SEPARATOR . "Misc" . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "web.php";

        // run router
        $router->run();

        // process response in send to the clint
        $this->response->end();
    }
}