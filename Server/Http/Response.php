<?php

namespace Electro\Server\Http;

use Electro\App\Abstraction\Json\BaseJsonInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\View\TemplateEngineInterface;
use Electro\App\Exceptions\Server\CanNotDoubleSendResponseException;

class Response implements \Electro\App\Abstraction\Server\ResponseInterface
{

    /**
     * added headers store here
     * @var array
     */
    private array $_headers  = [];

    /**
     * status code store here
     * @var int
     */
    private int $_statusCode = 200;


    /**
     * if body are added to response, response are locked
     * @var bool
     */
    private bool $is_lock = false;

    /**
     * if response are view this var set to true
     * @var bool
     */
    private bool $is_view = false;


    private ?TemplateEngineInterface $_view = null;

    /**
     * @var bool
     */
    private bool $is_ended = false;

    /**
     * @inheritDoc
     */
    public function addHeader(string $key, string $value): ResponseInterface
    {
        $this->_headers[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addHeaders(array $headers): ResponseInterface
    {
        foreach ($headers as $name=>$header)
            $this->addHeader($name,$header);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function status(int $code): ResponseInterface
    {
        $this->_statusCode = $code;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function view(TemplateEngineInterface $view): ResponseInterface
    {
        if (!$this->isIsLock()) {
            $this->is_view = true;
            $this->_view = $view;
            $this->send();
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function json(BaseJsonInterface|array $body): ResponseInterface
    {
        if (!$this->isIsLock()){
            $this->is_lock = true;
            $this->addHeader("Content-Type","application/json")->body(json_encode($body))->send();
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(TemplateEngineInterface|BaseJsonInterface|array|string $body = null): ResponseInterface
    {
        if (!$this->is_lock){
            if (is_null($body)) {
                $this->is_lock = true;
                return $this;
            } elseif ($body instanceof TemplateEngineInterface) {
                $this->view($body);
            } elseif (is_string($body)) {
                $this->body($body);
            } else {
                $this->json($body);
            }
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function end(): bool
    {
        if ($this->is_ended){
            throw new CanNotDoubleSendResponseException();
        }else{
            foreach ($this->_headers as $key=>$header){
                header("{$key}: {$header}");
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function redirect(string $url): ResponseInterface
    {
        // TODO: Implement redirect() method.
    }

    /**
     * @inheritDoc
     */
    public function cookie(string $name, string $value, int $lifetime = 3600, array $options = []): ResponseInterface
    {
        // TODO: Implement cookie() method.
    }

    /**
     * @inheritDoc
     */
    public function session(string $name, string $value, array $param): ResponseInterface
    {
        // TODO: Implement session() method.
    }

    /**
     * @return bool
     */
    public function isIsLock(): bool
    {
        return $this->is_lock;
    }

    /**
     * @return bool
     */
    public function isIsView(): bool
    {
        return $this->is_view;
    }

    public function body(string $body): ResponseInterface
    {
        // TODO: Implement body() method.
    }

    /**
     * @return bool
     */
    public function isIsEnded(): bool
    {
        return $this->is_ended;
    }
}