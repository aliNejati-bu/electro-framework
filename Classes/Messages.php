<?php

namespace RemoteConfig\Classes;

class Messages
{

    /**
     * self instance for set this class to singleton
     * @var ?Messages
     */
    private static ?Messages $massages = null;

    /**
     * @var string[]
     */
    public array $errors = [];

    /**
     * @var string[]
     */
    public array $messages = [];

    /**
     * @var string[]
     */
    public array $newError = [];


    /**
     * @var string[]
     */
    public array $newMessages = [];

    private function __construct()
    {

        $this->errors = $_SESSION["errors"] ?? []; // get past error
        $this->messages = $_SESSION["messages"] ?? []; // get past message
        $_SESSION["errors"] = []; // unset error session
        $_SESSION["messages"] = []; // unset massages session
    }

    /**
     * add new error
     * @param string $errorName
     * @param string $errorValue
     * @return Messages
     */
    public function setError(string $errorName, string $errorValue): Messages
    {
        $this->errors[$errorName] = $errorValue; // set for pass to view
        $this->newError[$errorName] = $errorValue; // set for pass to view
        return $this;
    }

    /**
     * add new message
     * @param string $messageName
     * @param string $messageValue
     * @return Messages
     */
    public function setMessage(string $messageName, string $messageValue): Messages
    {
        $this->messages[$messageName] = $messageValue; // set for pass to view
        $this->newMessages[$messageName] = $messageValue; // set for pass to view
        return $this;
    }

    public static function getInstance(): Messages
    {
        if (self::$massages == null) {
            self::$massages = new self();
        }
        return self::$massages;
    }

    public function isError()
    {
        return count($this->errors) != 0;
    }

    public function isMessage()
    {
        return count($this->messages) != 0;
    }

    public function getError(string $errorName, mixed $default = false)
    {
        return $this->errors[$errorName] ?? $default;
    }
}
// TODO: همه فعالیت های مربوط به پیغام ترنسنسپورتیشن در ایجا انجام شود.