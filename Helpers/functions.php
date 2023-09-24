<?php


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Electro\Classes\Auth;
use Electro\Classes\Messages;
use Electro\Classes\Redirect;
use Electro\Classes\Request;
use Electro\Classes\ViewEngine;

#[Pure] function redirect(string $target = ""): Redirect
{
    return new Redirect($target);
}

function view(string $name, array $vars = []): ViewEngine
{
    return ViewEngine::getInstance($name, $vars);
}

/**
 * @return mixed
 */
function back(): mixed
{
    return $_SERVER["HTTP_REFERER"] ?? "javascript:history.go(-1)";
}

/**
 * @return array|mixed|string[]
 */
function errors(): array
{
    return Messages::getInstance()->errors;
}

/**
 * @param string $name
 * @param bool $default
 * @return mixed
 */
function error(string $name, bool $default = false): mixed
{
    return Messages::getInstance()->getError($name, $default);
}

function route($name, ...$params)
{
    if (!isset(\Electro\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name])) {
        return '/';
    }
    $route = \Electro\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name];
    foreach ($params as $param) {
        $route = str_replace("!-!", $param, $route);
    }
    return $route;
}

/**
 * @return bool
 */
function isError(): bool
{
    return Messages::getInstance()->isError();
}

/**
 * @return Request
 */
function request(): Request
{
    return Request::getInstance();
}

/**
 * @return Auth|null
 */
function auth(): ?Auth
{
    return \request()->auth;
}

/**
 * @param string $viewName
 * @return string
 */
function viewPath(string $viewName): string
{
    $baseViewPath = \Electro\Classes\Config::getInstance()->getAllConfig("view")["baseViewDirectory"];
    return $baseViewPath . DIRECTORY_SEPARATOR . str_replace(">", DIRECTORY_SEPARATOR, $viewName) . ".php";
}

/**
 * @return string
 */
function get404ViewName(): string
{
    return \Electro\Classes\Config::getInstance()->getAllConfig("view")["404"];
}


function _404()
{
    http_response_code(404);
    return view(get404ViewName());
}


/**
 * @return bool
 */
function isHtmlAccept(): bool
{
    return str_contains($_SERVER["HTTP_ACCEPT"], "text/html") || str_contains($_SERVER["HTTP_ACCEPT"], "TEXT/HTML") || str_contains($_SERVER["HTTP_ACCEPT"], "text/htm");
}


/**
 * @return bool
 */
function isJsonAccept(): bool
{
    return str_contains($_SERVER["HTTP_ACCEPT"], "application/json") || str_contains($_SERVER["HTTP_ACCEPT"], "application/JSON") || str_contains($_SERVER["HTTP_ACCEPT"], "*/*");
}

#[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] function responseJson(bool $status, array $messages, mixed $data = null): array
{
    return [
        "status" => $status,
        "messages" => $messages,
        "data" => $data
    ];
}

function sms()
{
    return \Electro\Classes\SMS\SMSManager::getInstance();
}


function getActiveCode($n): string
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

/**
 * @param int $n size
 * @return string
 */
function getRandomString(int $n): string
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


function getRandomPassword($n): string
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


/**
 * @return bool
 */
function isMessage(): bool
{
    return Messages::getInstance()->isMessage();
}

/**
 * @return array|mixed|string[]
 */
function messages(): mixed
{
    return Messages::getInstance()->messages;
}


/**
 * @return string
 */
function getStartDay(): string
{
    return date("Y-m-d H:i:s", strtotime("today"));
}


function includeView(string $viewName)
{
    require BASE_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . str_replace('>', DIRECTORY_SEPARATOR, $viewName) . ".php";
}

function getAPI_KEY()
{
    return "mcmtnayRu1f9h1oxbAmfRTDitUSDaM9QGV4ZWwaZgIAegBamd7IneR1dAKuUdc97";
}

function sendCreateAccountSMS($mobile, $name, $user, $pass)
{
    $url = "https://api.sms.ir/v1/send/verify";


    $SMS_API_KEY = getAPI_KEY();
    $headers = array(
        "X-API-KEY: $SMS_API_KEY",
        "Content-Type: application/json"
    );


    $data = array(
        "Mobile" => $mobile,
        "TemplateId" => 967321,
        "Parameters" => array(
            array("Name" => "NAME", "Value" => $name),
            array("Name" => "USER", "Value" => $user),
            array("Name" => "PASS", "Value" => $pass)
        )
    );

    return extracted($url, $data, $headers);
}

function sendInputPostData($mobile, $name)
{
    $url = "https://api.sms.ir/v1/send/verify";


    $SMS_API_KEY = getAPI_KEY();
    $headers = array(
        "X-API-KEY: $SMS_API_KEY",
        "Content-Type: application/json"
    );


    $data = array(
        "Mobile" => $mobile,
        "TemplateId" => 819422,
        "Parameters" => array(
            array("Name" => "NAME", "Value" => $name),
        )
    );

    return extracted($url, $data, $headers);
}

function acceptPostalData($mobile, $name)
{
    $url = "https://api.sms.ir/v1/send/verify";


    $SMS_API_KEY = getAPI_KEY();
    $headers = array(
        "X-API-KEY: $SMS_API_KEY",
        "Content-Type: application/json"
    );


    $data = array(
        "Mobile" => $mobile,
        "TemplateId" => 273775,
        "Parameters" => array(
            array("Name" => "NAME", "Value" => $name),
        )
    );

    return extracted($url, $data, $headers);
}


function rejectPostalData($mobile, $name)
{
    $url = "https://api.sms.ir/v1/send/verify";


    $SMS_API_KEY = getAPI_KEY();
    $headers = array(
        "X-API-KEY: $SMS_API_KEY",
        "Content-Type: application/json"
    );


    $data = array(
        "Mobile" => $mobile,
        "TemplateId" => 568343,
        "Parameters" => array(
            array("Name" => "NAME", "Value" => $name),
        )
    );

    return extracted($url, $data, $headers);
}


function createUser($phone, $name, $password)
{


    $user = \Electro\App\Model\User::create([
        'phone' => $phone,
        'name' => $name,
        'password' => $password
    ]);


    sendCreateAccountSMS($user->phone, $user->name, $user->phone, $password);
    return $user;
}

function getStatus($status)
{
    switch ($status) {
        case "pending":
            return "در انتظار تایید مدیریت";
        case "waiting_for_user":
            return "در حال آماده سازی | انتظار ورود اطلاعات";
        case "processing":
            return "ارسال به چاپ خانه";
        case "ended":
            return "پایان یافته";
    }
}

function dd(...$vars)
{
    foreach ($vars as $var) {
        var_dump($var);
    }
    die();
}


function getTimeDist(int $time)
{
    $now = time();
    $dist = $now - $time;
    if ($dist < 60) {
        return $dist . " ثانیه پیش";
    } else if ($dist < 3600) {
        return floor($dist / 60) . " دقیقه پیش";
    } else if ($dist < 86400) {
        return floor($dist / 3600) . " ساعت پیش";
    } else if ($dist < 2592000) {
        return floor($dist / 86400) . " روز پیش";
    } else if ($dist < 31104000) {
        return floor($dist / 2592000) . " ماه پیش";
    } else {
        return floor($dist / 31104000) . " سال پیش";
    }
}


function url()
{
    return \Electro\Classes\Config::getInstance()->getAllConfig("app")["app_url"];
}


function sendCode(string $mobile, $code)
{
    $url = "https://api.sms.ir/v1/send/verify";


    $SMS_API_KEY = getAPI_KEY();
    $headers = array(
        "X-API-KEY: $SMS_API_KEY",
        "Content-Type: application/json"
    );


    $data = array(
        "Mobile" => $mobile,
        "TemplateId" => 811275,
        "Parameters" => array(
            array("Name" => "CODE", "Value" => $code),
        )
    );

    return extracted($url, $data, $headers);
}

/**
 * @param string $url
 * @param array $data
 * @param array $headers
 * @return bool
 */
function extracted(string $url, array $data, array $headers): bool
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


    curl_close($ch);

    if ($httpCode == 200) {
        return true;
    } else {
        return false;
    }
}


function isEnglish(string $str)
{
    $valids = 'a b c d e f g h i j k l m n o p q r s t u v w x y z';
    $valids .= ' ' . strtoupper($valids);
    $valids = explode(' ', $valids);
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == ' ') {
            continue;
        }
        if (!in_array($str[$i], $valids)) {
            return false;
        }
    }
    return true;
}