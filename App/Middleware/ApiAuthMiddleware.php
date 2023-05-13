<?php

namespace Electro\App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Electro\Classes\Auth;
use Electro\Classes\Config;
use Electro\Classes\Request;

class ApiAuthMiddleware implements \Electro\Boot\Interfaces\MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        $configs = Config::getInstance()->getAllConfig('auth');
        if (!isset(\request()->headers()["Authorization"])) {
            http_response_code(403);
            return json_encode(responseJson(false, [], "token error."));
        }
        try {
            $token = explode(" ", \request()->headers()["Authorization"])[1];
            $payLoad = JWT::decode($token, new Key($configs["jwt_key"], $configs["jwt_alg"]));
            Request::getInstance()->auth = (new Auth())->createUSer($payLoad->id);
            return true;
        } catch (\Throwable $e) {
            http_response_code(403);
            return json_encode(responseJson(false, [], "token error."));

        }
    }
}