<?php

namespace Electro\Providers\TemplateEngineService;

use Electro\App\Abstraction\View\TemplateEngineInterface;
use Electro\App\Exceptions\TemplateEngine\ViewNotExistException;

class TemplateEngineService implements \Electro\App\Abstraction\View\TemplateEngineInterface
{

    /**
     * @var array
     */
    private array $params = [];

    /**
     * @var string
     */
    private string $path = "";

    /**
     * @var string
     */
    private string $name = "";

    /**
     * @inheritDoc
     */
    public function __construct(string $name, array $params, string $projectBaseDirectory, string $path = "Views", string $prifix = ".electro.php")
    {
        $this->params = $params;
        $this->name = $name;
        $name = str_replace(">",DIRECTORY_SEPARATOR,$name);
        $path = $projectBaseDirectory . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $name . $prifix;
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function addParam(string $key, mixed $value): TemplateEngineInterface
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     * @throws ViewNotExistException
     */
    public function render(array $params = [], array $options = []): string
    {
        if (file_exists($this->path)) {
            foreach ($params as $name=>$param){
                $this->addParam($name,$param);
            }
            foreach ($this->params as $name=>$param){
                $$name = $param;
            }
            ob_start();
            require_once $this->path;
            return ob_get_clean();
        } else {
            throw new ViewNotExistException($this->path);
        }
    }



}