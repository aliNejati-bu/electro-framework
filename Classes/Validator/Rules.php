<?php

namespace RemoteConfig\Classes\Validator;

use Closure;
use Illuminate\Database\Eloquent\Model;
use RemoteConfig\Classes\Config;

class Rules
{

    /**
     * @return Closure
     */
    public static function iranPhoneNumber(): Closure
    {
        return function ($value) {
            if (!preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/', $value)) {
                return "rule.phone_number";
            }
            return true;
        };
    }

    /**
     * @param $model
     * @param string $field
     * @return Closure
     */
    public static function unique($model, string $field): Closure
    {
        /**
         * @param $value
         * @return bool|string
         * @throws \Exception
         */
        return function ($value) use ($model, $field): bool|string {
            $result = $model::where($field, $value)->first();
            if (!is_null($result)) {
                return 'rule.unique';
            }
            return true;
        };
    }


    /**
     * @throws \Exception
     */
    private static function getMassage($ruleName): string
    {
        $appLang = Config::getInstance()->getAllConfig("app")["lang"] ?? "fa";

        $langPath = BASE_DIR . DIRECTORY_SEPARATOR . "Classes" . DIRECTORY_SEPARATOR . "Validator" . DIRECTORY_SEPARATOR . "Lang" . DIRECTORY_SEPARATOR . $appLang;
        if (!file_exists($langPath)) {
            throw new \Exception($langPath . " is not lang!.");
        }

        if (!file_exists($langPath . DIRECTORY_SEPARATOR . "lang.php") || !file_exists($langPath . DIRECTORY_SEPARATOR . "attributeAliases.php")) {
            throw new \Exception($langPath . " is not lang!.");
        }

        $langArray = require $langPath . DIRECTORY_SEPARATOR . "lang.php";
        return $langArray[$ruleName];
    }
}