<?php

namespace Electro\App\Abstraction\View;


interface TemplateEngineInterface
{

    /**
     * @param string $name name of view
     * @param array $params parameters passed to view
     * @param string $path path of views directory (relative from root directory)
     */
    public function __construct(string $name, array $params,string $projectBaseDirectory, string $path = "Views",string $prifix = ".electro.php");

    /**
     * @param string $key variable name in view
     * @param string $value variable value in view
     * @return TemplateEngineInterface add parameter to view
     * add parameter to view
     */
    public function addParam(string $key, mixed $value): TemplateEngineInterface;


    /**
     * get string of returned view
     * @param array $params parameters passed to view
     * @param array $options
     * @return string
     * for render a view
     */
    public function render(array $params = [], array $options = []): string;


}