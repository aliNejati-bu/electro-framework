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
    public function addHeader(string $key, string $value) : ResponseInterface;


    /**
     * @param array $header array of headers
     * @return ResponseInterface
     */
    public function addHeaders(array $header): ResponseInterface;


    /**
     * @param int $code status code for return
     * @return ResponseInterface
     */
    public function status(int $code) : ResponseInterface;

    /**
     * @param TemplateEngineInterface $view
     * @return ResponseInterface
     */
    public function view(TemplateEngineInterface $view): ResponseInterface;

    /**
     * @param object|array $body json body
     * @return ResponseInterface
     */
    public function json(BaseJsonInterface|array $body):ResponseInterface;

    public function send(mixed $body):ResponseInterface;



}