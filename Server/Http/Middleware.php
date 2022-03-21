<?php

namespace Electro\Server\Http;

use Electro\App\Abstraction\Server\MiddlewareInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Exceptions\Server\InvalidMiddlewareException;
use Electro\App\Exceptions\Server\MiddlewareNotFoundException;
use function DI\string;

class Middleware implements \Electro\App\Abstraction\Server\MiddlewareCoreInterface
{

    private array $middlewares = [];

    /**
     * @inheritDoc
     *
     */
    public function RegisterMiddleWare(string $name, string $middleware): void
    {
        if (class_exists($middleware)) {
            $middlewareInstance = new $middleware;
            if (!($middlewareInstance instanceof MiddlewareInterface)) {
                throw new InvalidMiddlewareException($middleware);
            }
            $this->middlewares[$name] = $middlewareInstance;
        } else {
            throw new MiddlewareNotFoundException($name);
        }
    }

    /**
     * @inheritDoc
     */
    public function runMiddleware(array $middlewares, RequestInterface $request, ResponseInterface $response): bool
    {
        $result = true;
        foreach ($middlewares as $middleware) {
            $middlewareInstance = $this->getMiddlewareByName($middleware);
            $result = $middlewareInstance->run($request, $response);
            if (!$result){
                break;
            }
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getMiddlewareByName($name): MiddlewareInterface
    {
        if (isset($this->middlewares[$name])) {
            return $this->middlewares[$name];
        } else {
            throw new MiddlewareNotFoundException($name);
        }
    }
}