<?php

namespace Electro\App\Abstraction\View;


interface TemplateEngineInterface
{

    /**
     * @param string $name name of view
     * @param array $params parameters passed to view
     * @param string $path path of views directory (relative from root directory)
     */
    public function __construct(string $name, array $params, string $path = "views");

    /**
     * @param string $key variable name in view
     * @param string $value variable value in view
     * @return void
     * add parameter to view
     */
    public function addParam(string $key, string $value): TemplateEngineInterface;


    /**
     * get string of returned view
     * @param array $params parameters passed to view
     * @param array $options
     * @return string
     * for render a view
     */
    public function render(array $params = [], array $options = []): string;


    /**
     * @param string $name name of the view
     * @param array $params parameters passed to view
     * @param array $options
     * @param string $path path of views directory (relative from root directory)
     * @return TemplateEngineInterface
     */
    public static function factory(string $name, array $params, array $options = [], string $path = "views"): TemplateEngineInterface;

}