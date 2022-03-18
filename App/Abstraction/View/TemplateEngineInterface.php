<?php

namespace Electro\App\Abstraction\View;


interface TemplateEngineInterface
{

    /**
     * @param string $name name of view
     * @param string $path path of views directory (relative from root directory)
     */
    public function __construct(string $name, string $path = "views");

    /**
     * @param string $key variable name in view
     * @param string $value variable value in view
     * @return void
     * add parameter to view
     */
    public function addParam(string $key, string $value): void;


    /**
     * @param array $params parameters passed to view
     * @param array $options
     * for render a view
     */
    public function render(array $params, array $options = []): void;


    /**
     * @param string $name name of the view
     * @param array $params parameters passed to view
     * @param array $options
     * @param string $path path of views directory (relative from root directory)
     * @return TemplateEngineInterface
     */
    public static function factory(string $name, array $params, array $options = [], string $path = "views"): TemplateEngineInterface;

}