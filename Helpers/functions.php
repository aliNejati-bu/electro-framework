<?php


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use RemoteConfig\Classes\Auth;
use RemoteConfig\Classes\Messages;
use RemoteConfig\Classes\Redirect;
use RemoteConfig\Classes\Request;
use RemoteConfig\Classes\ViewEngine;

#[Pure] function redirect(string $target): Redirect
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
    if (!isset(\RemoteConfig\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name])) {
        return '/';
    }
    $route = \RemoteConfig\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name];
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
    $baseViewPath = \RemoteConfig\Classes\Config::getInstance()->getAllConfig("view")["baseViewDirectory"];
    return $baseViewPath . DIRECTORY_SEPARATOR . str_replace(">", DIRECTORY_SEPARATOR, $viewName) . ".php";
}

/**
 * @return string
 */
function get404ViewName(): string
{
    return \RemoteConfig\Classes\Config::getInstance()->getAllConfig("view")["404"];
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
    return \RemoteConfig\Classes\SMS\SMSManager::getInstance();
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
    return date("Y-m-d H:i:s",strtotime("today"));
}