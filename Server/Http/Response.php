<?php

namespace Electro\Server\Http;

use Electro\App\Abstraction\Json\BaseJsonInterface;
use Electro\App\Abstraction\Server\ResponseInterface;
use Electro\App\Abstraction\View\TemplateEngineInterface;
use Electro\App\Exceptions\Server\CanNotDoubleSendResponseException;
use Electro\App\Exceptions\Server\HeadersHasSentException;

class Response implements \Electro\App\Abstraction\Server\ResponseInterface
{

    /**
     * added headers store here
     * @var array
     */
    private array $_headers = [];

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
     * @var array saved sessions
     */
    private array $_sessions = [];

    private string $_body = '';


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
        foreach ($headers as $name => $header)
            $this->addHeader($name, $header);
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
        if (!$this->isIsLock()) {
            $this->is_lock = true;
            $this->addHeader("Content-Type", "application/json")->body(json_encode($body))->send();
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(TemplateEngineInterface|BaseJsonInterface|array|string $body = null): ResponseInterface
    {
        if (!$this->is_lock) {
            if (is_null($body)) {
                $this->is_lock = true;
                return $this;
            } elseif ($body instanceof TemplateEngineInterface) {
                $this->view($body);
            } elseif ($body instanceof BaseJsonInterface || is_array($body)) {
                $this->json($body);
            } else {
                $this->body($body);
                $this->is_lock = true;
            }
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function end(): bool
    {
        if ($this->is_ended) {
            throw new CanNotDoubleSendResponseException();
        } else {
            if (!headers_sent()) {
                foreach ($this->_headers as $key => $header) {
                    header("{$key}: {$header}");
                }
                foreach ($this->_sessions as $name => $value) {
                    $_SESSION[$name] = $value;
                }
            } else {
                throw new HeadersHasSentException();
            }
            $this->is_ended = true;
            if ($this->is_view) {
                $result = $this->_view->render();
                echo $result;
                return true;
            }
            echo $this->_body;
            return true;
        }
    }

    /**
     * @inheritDoc
     */
    public function redirect(string $url): ResponseInterface
    {
        if (!$this->is_lock) {
            $this->addHeader("Location", $url)->send();
        }
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function session(string $name, string $value): ResponseInterface
    {
        $this->_sessions[$name] = $value;
        return $this;
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
        if (!$this->is_lock) {
            $this->_body .= $body;
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsEnded(): bool
    {
        return $this->is_ended;
    }


    /**
     * @inheritDoc
     */
    public function cookie(string $name, string $value, int $lifetime = 3600, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false, array $options = []): ResponseInterface
    {
        setcookie($name, $value, $lifetime, $path, $domain, $secure, $httponly);
        return $this;
    }
}