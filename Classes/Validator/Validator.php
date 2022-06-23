<?php

namespace RemoteConfig\Classes\Validator;

use RemoteConfig\Classes\Config;
use RemoteConfig\Classes\Exception\ValidatorNotFoundException;
use Somnambulist\Components\Validation\Factory;
use Somnambulist\Components\Validation\Validation;

class Validator
{

    /**
     * @var Validator|null
     */
    private static ?Validator $validator = null;

    /**
     * @var array
     */
    private array $rules = [];


    /**
     * @var array
     */
    private array $input = [];


    /**
     * @param Config $config
     */
    public function __construct(private Config $config)
    {
    }


    /**
     * @param array $input
     * @param array $rules
     * @return Validator
     */
    public function makeFromProvidedRule(array $input, array $rules): static
    {
        $this->rules = $rules;
        $this->input = $input;
        return $this;
    }


    /**
     * @param array $input
     * @param string $validatorName
     * @return $this
     * @throws ValidatorNotFoundException
     */
    public function makeFromValidator(array $input, string $validatorName): static
    {
        $validatorsPath = $this->config->getAllConfig("validator")["validators_path"] . DIRECTORY_SEPARATOR . $validatorName . ".php";
        if (!file_exists($validatorsPath)) {
            throw new ValidatorNotFoundException($validatorsPath);
        }


        $this->rules = require $validatorsPath;
        $this->input = $input;


        return $this;
    }


    /**
     * @return Validation
     * @throws \Exception
     */
    public function validate(): Validation
    {
        $validation = (new Factory)->make($this->input,$this->rules);

        $appLang = $this->config->getAllConfig("app")["lang"] ?? "fa";

        $langPath = BASE_DIR . DIRECTORY_SEPARATOR . "Classes" . DIRECTORY_SEPARATOR . "Validator" . DIRECTORY_SEPARATOR . "Lang" . DIRECTORY_SEPARATOR . $appLang;
        if (!file_exists($langPath)) {
            throw new \Exception($langPath . " is not lang!.");
        }

        if (!file_exists($langPath . DIRECTORY_SEPARATOR . "lang.php") || !file_exists($langPath . DIRECTORY_SEPARATOR . "attributeAliases.php")) {
            throw new \Exception($langPath . " is not lang!.");
        }


        $langArray = require $langPath . DIRECTORY_SEPARATOR . "lang.php";
        $attributes = require $langPath . DIRECTORY_SEPARATOR . "attributeAliases.php";


        $validation->messages()->add($appLang, $langArray);


        foreach ($attributes as $key => $value) {
            $validation->setAlias($key, $value);
        }

        $validation->setLanguage($appLang)->validate();
        return $validation;
    }


    /**
     * @return static
     */
    public static function getInstance(): static
    {
        return new self(Config::getInstance());
    }

}