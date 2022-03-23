<?php

namespace Electro\Server\Http;

use Electro\App\Abstraction\Server\Misc\FileInterface;
use Electro\App\Abstraction\Server\RequestInterface;
use Electro\App\Exceptions\Server\FileNotExistsException;
use Electro\Server\Misc\FileHandler;
use JetBrains\PhpStorm\Pure;
use stdClass;

class Request implements RequestInterface
{

    /**
     * @var FileHandler[]
     */
    public array $_files = [];



    #[Pure] public function __construct()
    {
        foreach ($_FILES as $name => $FILE) {
            $extension = explode(".", $FILE["name"]);
            $extension = $extension[count($extension) - 1];
            $this->_files[$name] = new FileHandler($FILE["name"], $FILE["tmp_name"], $FILE["size"], $FILE["type"], $extension);
        }
    }

    /**
     * @inheritDoc
     */
    public function gets(): array
    {
        return $_GET;
    }

    /**
     * @inheritDoc
     */
    public function posts(): array
    {
        return $_POST;
    }

    /**
     * @inheritDoc
     */
    public function headers(): array
    {
        return getallheaders();
    }

    /**
     * @inheritDoc
     */
    public function cookies(): array
    {
        return $_COOKIE;
    }

    /**
     * @inheritDoc
     */
    public function sessions(): array
    {
        return $_SESSION;
    }


    /**
     * @inheritDoc
     */
    #[Pure] public function post(?string $name = null): string|null|array
    {
        if (is_null($name)) {
            return $this->posts();
        }
        return $this->posts()[$name];
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function header(?string $name = null): string|null|array
    {
        if (is_null($name)) {
            return $this->headers();
        }
        return $this->headers()[$name];
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function get(?string $name = null): string|null|array
    {
        if (is_null($name)) {
            return $this->gets();
        }
        return $this->gets()[$name];
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function cookie(?string $name = null): string|null|array
    {
        if (is_null($name)) {
            return $this->cookies();
        }
        return $this->cookies()[$name];
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function session(?string $name = null): string|null|array
    {
        if (is_null($name)) {
            return $this->sessions();
        }
        return $this->sessions()[$name];
    }

    /**
     * @inheritDoc
     */
    public function jsonBody(): stdClass|null
    {
        if ($this->isJsonSended()) {
            $content = file_get_contents('php://input');
            if (!isJson($content)) {
                return null;
            }
            return json_decode($content);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function body(): stdClass
    {
        if (!$this->isJsonSended()) {
            return convertToObject($_REQUEST);
        } else {
            return $this->jsonBody();
        }
    }

    private function isJsonSended(): bool
    {
        $contentType = "*";
        if (!is_null($this->header("Content-Type"))) {
            $contentType = $this->header("Content-Type");
        } elseif (!is_null($this->header("content-Type"))) {
            $contentType = $this->header("content-Type");
        } elseif ($this->header("CONTENT-TYPE")) {
            $contentType = $this->header("CONTENT-TYPE");
        } elseif (!is_null($this->header("content-type"))) {
            $contentType = $this->header("content-type");
        }
        $contentType = strtolower($contentType);
        if (str_contains($contentType, "application/json")) {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getMethode(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @inheritDoc
     */
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @inheritDoc
     */
    public function files(): array
    {
        return $this->_files;
    }

    /**
     * @inheritDoc
     */
    public function file(string $name): FileInterface
    {
        if (isset($this->_files[$name])){
            return $this->_files[$name];
        }else{
            throw new FileNotExistsException($name);
        }
    }
}