<?php

namespace RemoteConfig\Classes;

use JetBrains\PhpStorm\NoReturn;

class Redirect
{
    /**
     * @var string[]
     */
    private array $errors = [];

    /**
     * @var string[]
     */
    private array $messages = [];

    /**
     * @param string $target target of redirection
     */
    public function __construct(private string $target)
    {
    }

    /**
     * for set error
     * @param string $errorName
     * @param string $errorValue
     * @return $this
     */
    public function with(string $errorName, string $errorValue): Redirect
    {
        $this->errors[$errorName] = $errorValue;
        return $this;
    }

    /**
     * for add message
     * @param string $messageName
     * @param string|null $messageVale
     * @return $this
     */
    public function withMessage(string $messageName, ?string $messageVale): Redirect
    {
        $this->messages[$messageName] = $messageVale;
        return $this;
    }

    #[NoReturn] public function exec(): void
    {
        $errors = array_merge($this->errors, Messages::getInstance()->errors);
        $_SESSION["errors"] = $errors;
        $messages = array_merge($this->messages, Messages::getInstance()->messages);
        $_SESSION["messages"] = $messages;
        header("Location: " . $this->target);
        die();
        // TODO: fix bug add errors and messages.
    }

}