<?php

namespace Electro\App\Abstraction\Server;

use Electro\App\Abstraction\Json\BaseJsonInterface;
use Electro\App\Abstraction\View\TemplateEngineInterface;
use Electro\App\Exceptions\Server\CanNotDoubleSendResponseException;
use Electro\App\Exceptions\Server\HeadersHasSentException;

interface ResponseInterface
{

    const MESSAGE_SESSION_NAME = "ele_msg";
    const ERROR_SESSION_NAME = "ele_err";

    /**
     * @param string $key name of the header
     * @param string $value value of the header
     * @return ResponseInterface
     */
    public function addHeader(string $key, string $value): ResponseInterface;


    /**
     * @param array $headers array of headers
     * @return ResponseInterface
     */
    public function addHeaders(array $headers): ResponseInterface;


    /**
     * @param int $code status code for return
     * @return ResponseInterface
     */
    public function status(int $code): ResponseInterface;

    /**
     * @param TemplateEngineInterface $view
     * @return ResponseInterface
     */
    public function view(TemplateEngineInterface $view): ResponseInterface;

    /**
     * @param BaseJsonInterface|array $body
     * @return ResponseInterface
     */
    public function json(BaseJsonInterface|array $body): ResponseInterface;

    /**
     * send and lock the response
     * @param string|array|BaseJsonInterface|TemplateEngineInterface|null $body
     * @return ResponseInterface
     */
    public function send(string|array|BaseJsonInterface|TemplateEngineInterface $body = null): ResponseInterface;

    /**
     * @return bool
     * @throws CanNotDoubleSendResponseException
     * @throws HeadersHasSentException
     */
    public function end(): bool;

    /**
     * @param string $url url for redirect
     * @return ResponseInterface
     * for redirect
     */
    public function redirect(string $url): ResponseInterface;

    /**
     * @param string $name
     * @param string $value
     * @param int $lifetime lifetime in second
     * @param array $options
     * @return ResponseInterface
     * set cookie
     */
    public function cookie(string $name, string $value, int $lifetime = 3600, string $path = "", string $domain = "", bool $secure = false,
                           bool   $httponly = false, array $options = []): ResponseInterface;


    /**
     * @param string $name
     * @param string $value
     * @return ResponseInterface
     */
    public function session(string $name, string $value): ResponseInterface;

    /**
     * @return bool if response has body true
     */
    public function isIsLock(): bool;

    /**
     * @return bool is response are TemplateEngineInterface true
     */
    public function isIsView(): bool;


    /**
     * @param string $body
     * @return ResponseInterface
     */
    public function body(string $body): ResponseInterface;

    /**
     * @return bool
     */
    public function isIsEnded(): bool;

    /**
     * @return bool
     */
    public function isHtmlAccept(): bool;

    /**
     * @param string $name
     * @param string $value
     * @return ResponseInterface
     */
    public function withError(string $name, string $value): ResponseInterface;


    public function withMessage(string $name, string $value): ResponseInterface;


}