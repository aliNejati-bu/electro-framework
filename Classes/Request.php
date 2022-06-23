<?php

namespace RemoteConfig\Classes;

use RemoteConfig\Classes\Validator\Validator;
use Somnambulist\Components\Validation\Validation;

class Request
{


    /**
     * @var bool
     */
    public bool $isApi = false;

    public ?Auth $auth = null;
    /**
     * @var Request|null
     */
    private static ?Request $request = null;

    /**
     * @var array
     */
    private array $validated = [];

    /**
     * @var bool
     */
    private bool $isValidatorError = false;

    /**
     * @var bool
     */
    private bool $isValidated = false;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @var array
     */
    private array $invalidData = [];

    /**
     * @param Validator $validator
     */
    public function __construct(private Validator $validator)
    {
    }


    /**
     * @return array
     */
    public function allPost(): array
    {
        if (strtolower($this->headers()["Content-Type"]) == "application/json") {
            return json_decode(file_get_contents('php://input'), true);
        } else {
            return $_POST + $_FILES;
        }
    }


    /**
     * @param string $name
     * @param bool $isRedirectBack
     * @return Validation
     * @throws Exception\ValidatorNotFoundException
     */
    public function validatePostsAndFiles(string $name, bool $isRedirectBack = true): Validation
    {
        $preparer = $this->validator->makeFromValidator($this->allPost(), $name);
        $validateResult = $preparer->validate();
        $this->isValidated = true;
        if ($validateResult->fails()) {
            if ($isRedirectBack) {
                if (isHtmlAccept()) {
                    $redirect = redirect(back());
                    foreach ($validateResult->errors()->firstOfAll() as $name => $value) {
                        $redirect->with($name, $value);
                    }
                    $redirect->exec();
                } else {
                    header("Content-Type: application/json");
                    http_response_code(400);
                    echo json_encode(responseJson(false, $validateResult->errors()->firstOfAll(), "validation filed."));
                    die();
                }
            }
            $this->isValidatorError = true;
            $this->errors = $validateResult->errors()->firstOfAll();
            $this->validated = $validateResult->getValidData();
            $this->invalidData = $validateResult->getInvalidData();
            return $validateResult;
        }
        $this->validated = $validateResult->getValidData();
        $this->invalidData = $validateResult->getInvalidData();
        $this->errors = $validateResult->errors()->firstOfAll();
        return $validateResult;
    }

    /**
     * @return array
     */
    public function getValidated(): array
    {
        return $this->validated;
    }

    /**
     * @return bool
     */
    public function isValidatorError(): bool
    {
        return $this->isValidatorError;
    }

    /**
     * @return bool
     */
    public function isValidated(): bool
    {
        return $this->isValidated;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getInvalidData(): array
    {
        return $this->invalidData;
    }

    /**
     * @return Request
     */
    public static function getInstance(): Request
    {
        if (is_null(self::$request))
            self::$request = new self(Validator::getInstance());
        return self::$request;
    }

    /**
     * @return bool|array
     */
    public function headers(): bool|array
    {
        return getallheaders();
    }

    /**
     * @return string
     */
    public function ip(): string
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}