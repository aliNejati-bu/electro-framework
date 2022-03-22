<?php
declare(strict_types=1);

namespace Electro\Server\Router;

use Electro\App\Abstraction\Server\MiddlewareCoreInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\Server\Router\RouterInterface;
use Electro\App\Exceptions\Server\ControllerMethodNotFound;
use Electro\App\Exceptions\Server\ControllerNotFoundException;
use Electro\App\Exceptions\Server\HandlerIsNotCallable;
use Electro\App\Exceptions\Server\ResponseLockedBeforeHandleController;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

class ElectroRouterHandler implements \Electro\App\Abstraction\Server\Router\RouterInterface
{

    /**
     * @var RouteCollector
     */
    private RouteCollector $routeCollector;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;


    /**
     * @var array get handlers poll
     */
    private array $_getHandlers = [];

    /**
     * @var array post handlers poll
     */
    private array $_postHandlers = [];


    /**
     * @var array put handlers poll
     */
    private array $_putHandlers = [];

    /**
     * @var array patch handlers poll
     */
    private array $_patchHandlers = [];


    /**
     * @var array delete handlers poll
     */
    private array $_deleteHandlers = [];

    /**
     * @var array for cache controller instance
     */
    private array $_controllerInstanceCache = [];


    /**
     * @var string for store prefix of routes
     */
    private string $_prefix = "";

    /**
     * @var string[]
     */
    private array $globalMiddlewares = [];

    /**
     * @var string
     */
    private string $_namespace = "";

    /**
     * @var MiddlewareCoreInterface
     */
    private MiddlewareCoreInterface $middlewareCore;

    private array $_routedMiddleware;

    /**
     * @var callable|null
     */
    private $_404Handler = null;

    /**
     * @inheritDoc
     */
    public function __construct(ResponseInterface $response, RequestInterface $request, MiddlewareCoreInterface $middlewareCore)
    {
        $this->routeCollector = new RouteCollector();
        $this->response = $response;
        $this->request = $request;
        $this->middlewareCore = $middlewareCore;

    }

    /**
     * @param string $class
     * @return mixed
     * @throws ControllerNotFoundException
     */
    private function searchClass(string $class): mixed
    {
        if (class_exists($class)) {
            if (isset($this->_controllerInstanceCache[$class])) {
                return $this->_controllerInstanceCache[$class];
            }
            $classInstance = new $class;
            $this->_controllerInstanceCache[$class] = $classInstance;
            return $classInstance;
        } else {
            throw new ControllerNotFoundException($class);
        }
    }

    /**
     * this method convert 'Controller@method' to callable
     * @param callable|string $handler
     * @return callable
     * @throws ControllerMethodNotFound
     * @throws ControllerNotFoundException
     * @throws HandlerIsNotCallable
     */
    private function prepareHandler(callable|string $handler): callable
    {
        // check for is controller
        if (is_string($handler)) {
            if (str_contains($handler, '@')) {
                list($class, $method) = explode('@', $handler);
                $class = $this->_namespace . "\\" . $class;
                $classInstance = $this->searchClass($class);
                if (method_exists($classInstance, $method)) {
                    $handler = [$classInstance, $method];
                } else {
                    throw new ControllerMethodNotFound($class, $method);
                }
            }
        }
        if (!is_callable($handler)) {
            throw new HandlerIsNotCallable((string)$handler);
        }
        return $handler;
    }

    /**
     * @inheritDoc
     */
    public function GET(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

        // prepare handler and convert controller pattern to callable
        $handler = $this->prepareHandler($handler);

        // get pattern if the name is not null convert to array with name and pattern
        $pattern = $this->getPattern($name, $pattern);
        $this->routeCollector->get($pattern, function (...$args) use ($middlewares, $handler) {
            $middlewares = array_merge($middlewares, $this->globalMiddlewares);
            $middlewareResult = $this->middlewareCore->runMiddleware($middlewares, $this->request, $this->response);
            if (!$middlewareResult) {
                return;
            }
            if ($this->response->isIsLock()) {
                throw new ResponseLockedBeforeHandleController();
            }
            $params = ["req" => $this->request, "res" => $this->response];
            $params = array_merge($params, $args);
            call_user_func_array($handler, $params);
        });
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function POST(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

        // prepare handler and convert controller pattern to callable
        $handler = $this->prepareHandler($handler);

        // get pattern if the name is not null convert to array with name and pattern
        $pattern = $this->getPattern($name, $pattern);

        $this->routeCollector->post($pattern, function (...$args) use ($middlewares, $handler) {
            $middlewares = array_merge($middlewares, $this->globalMiddlewares);
            $middlewareResult = $this->middlewareCore->runMiddleware($middlewares, $this->request, $this->response);
            if (!$middlewareResult) {
                return;
            }
            if ($this->response->isIsLock()) {
                throw new ResponseLockedBeforeHandleController();
            }
            $params = ["req" => $this->request, "res" => $this->response];
            $params = array_merge($params, $args);
            call_user_func_array($handler, $params);
        });
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function PUT(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

        // prepare handler and convert controller pattern to callable
        $handler = $this->prepareHandler($handler);

        // get pattern if the name is not null convert to array with name and pattern
        $pattern = $this->getPattern($name, $pattern);

        $this->routeCollector->put($pattern, function (...$args) use ($middlewares, $handler) {
            $middlewares = array_merge($middlewares, $this->globalMiddlewares);
            $middlewareResult = $this->middlewareCore->runMiddleware($middlewares, $this->request, $this->response);
            if (!$middlewareResult) {
                return;
            }
            if ($this->response->isIsLock()) {
                throw new ResponseLockedBeforeHandleController();
            }
            $params = ["req" => $this->request, "res" => $this->response];
            $params = array_merge($params, $args);
            call_user_func_array($handler, $params);
        });
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function PATCH(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

        // prepare handler and convert controller pattern to callable
        $handler = $this->prepareHandler($handler);

        // get pattern if the name is not null convert to array with name and pattern
        $pattern = $this->getPattern($name, $pattern);

        $this->routeCollector->patch($pattern, function (...$args) use ($middlewares, $handler) {
            $middlewares = array_merge($middlewares, $this->globalMiddlewares);
            $middlewareResult = $this->middlewareCore->runMiddleware($middlewares, $this->request, $this->response);
            if (!$middlewareResult) {
                return;
            }
            if ($this->response->isIsLock()) {
                throw new ResponseLockedBeforeHandleController();
            }
            $params = ["req" => $this->request, "res" => $this->response];
            $params = array_merge($params, $args);
            call_user_func_array($handler, $params);
        });
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function DELETE(string $pattern, callable|string $handler, string $name = "", array $middlewares = []): RouterInterface
    {

        // prepare handler and convert controller pattern to callable
        $handler = $this->prepareHandler($handler);

        // get pattern if the name is not null convert to array with name and pattern
        $pattern = $this->getPattern($name, $pattern);

        $this->routeCollector->delete($pattern, function (...$args) use ($middlewares, $handler) {
            $middlewares = array_merge($middlewares, $this->globalMiddlewares);
            $middlewareResult = $this->middlewareCore->runMiddleware($middlewares, $this->request, $this->response);
            if (!$middlewareResult) {
                return;
            }
            if ($this->response->isIsLock()) {
                throw new ResponseLockedBeforeHandleController();
            }
            $params = ["req" => $this->request, "res" => $this->response];
            $params = array_merge($params, $args);
            call_user_func_array($handler, $params);
        });
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function run(): void
    {
        try {
            $dispatcher = new Dispatcher($this->routeCollector->getData());
            $dispatcher->dispatch($this->request->getMethode(), parse_url($this->request->getRequestUri(), PHP_URL_PATH));
        } catch (HttpRouteNotFoundException $exception) {
            if (!is_null($this->_404Handler))
                call_user_func($this->_404Handler, $this->request, $this->response);
            throw $exception;
        }
    }

    /**
     * @inheritDoc
     * @throws HandlerIsNotCallable
     */
    public function group(string $prefix, callable $handler, array $middlewares = []): RouterInterface
    {
        $oldPreFix = $this->_prefix;
        $oldMiddlewares = $this->globalMiddlewares;
        $this->_prefix = $oldPreFix . $prefix;
        $this->globalMiddlewares = array_merge($oldMiddlewares, $middlewares);
        if (!is_callable($handler)) {
            throw new HandlerIsNotCallable((string)$handler);
        }
        call_user_func($handler, $this);
        $this->_prefix = $oldPreFix;
        $this->globalMiddlewares = $oldMiddlewares;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function namespace(string $namespace): RouterInterface
    {
        $this->_namespace = $namespace;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function middleware(string $path, array $middlewares): RouterInterface
    {
        $path = $this->_prefix . $path;
        if (isset($this->_routedMiddleware[$path])) {
            $this->_routedMiddleware[$path] = array_merge($this->_routedMiddleware[$path], $middlewares);
        } else {
            $this->_routedMiddleware[$path] = $middlewares;
        }
        return $this;
    }

    /**
     * if the name is not null convert to array with name and pattern and if empty return string of pattern
     * @param string $name
     * @param string $pattern
     * @return string|string[]
     */
    private function getPattern(string $name, string $pattern): string|array
    {
        if (empty($name)) {
            $pattern = $this->_prefix . $pattern;
        } else {
            $pattern = [$this->_prefix . $pattern, $name];
        }
        return $pattern;
    }

    /**
     * @inheritDoc
     */
    public function addGlobalMiddleware(array $middlewares): RouterInterface
    {
        $this->globalMiddlewares = array_merge($this->globalMiddlewares, $middlewares);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function set404(callable|string $handler): RouterInterface
    {
        $handler = $this->prepareHandler($handler);
        $this->_404Handler = $handler;
        return $this;
    }

    public function route(string $name, array $params = null): string
    {
        return "/" . $this->routeCollector->route($name, $params);
    }
}