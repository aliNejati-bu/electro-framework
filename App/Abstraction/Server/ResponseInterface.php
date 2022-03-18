<?php

namespace Electro\App\Abstraction\Server;

use Electro\App\Abstraction\json\BaseJsonInterface;
use Electro\App\Abstraction\View\TemplateEngineInterface;

interface ResponseInterface
{
    /**
     * @param string $key name of the header
     * @param string $value value of the header
     * @return ResponseInterface
     */
    public function addHeader(string $key, string $value): ResponseInterface;


    /**
     * @param array $header array of headers
     * @return ResponseInterface
     */
    public function addHeaders(array $header): ResponseInterface;


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
     * @param string|array|BaseJsonInterface|TemplateEngineInterface $body
     * @return ResponseInterface
     */
    public function send(string|array|BaseJsonInterface|TemplateEngineInterface $body): ResponseInterface;

    /**
     * @return bool
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
    public function cookie(string $name,string $value,int $lifetime = 3600,array $options = []): ResponseInterface;


}