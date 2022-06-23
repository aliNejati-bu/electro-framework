<?php

namespace RemoteConfig\Classes;

use RemoteConfig\Classes\Exception\ViewNotFoundedException;

class ViewEngine
{


    /**
     * passed variables to view
     * @var array
     */
    public array $passedVariables = [];


    public function __construct(private string $viewName, array $passedVariables, public Config $config)
    {
        $this->passedVariables = array_merge($this->passedVariables, $passedVariables);

    }


    public function addVariables(string $name, mixed $data): static
    {
        $this->passedVariables[$name] = $data;
        return $this;
    }

    /**
     * @param array $variables
     * @return string
     * @throws ViewNotFoundedException
     */
    public function render(array $variables = []): string
    {
        ob_start();
        foreach ($this->config->getAllConfig("view")["default_variables"] as $default_variableName => $value) {
            $$default_variableName = $value;
        }
        foreach ($this->passedVariables as $name => $variable) {
            $$name = $variable;
        }

        foreach ($variables as $name => $value) {
            $$name = $value;
        }
        $baseDir = $this->config->getAllConfig("view")["baseViewDirectory"];
        $viewPath = $baseDir . DIRECTORY_SEPARATOR . str_replace(">",DIRECTORY_SEPARATOR,$this->viewName) . ".php";
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundedException($viewPath);
        }
        require $viewPath;
        $result = ob_get_clean();
        return $result;
    }

    /**
     * @param $viewName
     * @param array $variables
     * @return ViewEngine
     */
    public static function getInstance($viewName, array $variables): ViewEngine
    {
        return new self($viewName, $variables, Config::getInstance());
    }

}