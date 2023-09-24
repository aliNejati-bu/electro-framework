<?php

namespace Electro\Classes;

use Firebase\JWT\JWT;
use Electro\App\Model\User;
use Electro\App\Model\UserSessionActivity;
use Firebase\JWT\Key;

class Auth
{
    /**
     * @var User|null
     */
    public ?User $userModel = null;


    /**
     * @var Auth|null
     */
    public static ?Auth $auth = null;

    public bool $isAuth = false;

    /**
     * @param string $email
     * @param string $password
     * @param bool $isLong
     * @return bool
     */
    public function doLogin(string $phone, string $password, bool $isLong = false): bool
    {
        $user = User::findUserByPhoneAndPassword($phone, $password);
        if (!$user) {
            return false;
        }
        $authConfig = Config::getInstance()->getAllConfig("auth");
        try {
            $key = $authConfig["jwt_key"];
            $iat = time();
            if ($isLong) {
                $exp = $iat + $authConfig["token_life_time_in_long"];
            } else {
                $exp = $iat + $authConfig["token_life_time"];
            }
            $payload = [
                'iat' => $iat,
                'exp' => $exp,
                'id' => $user->id
            ];
            $token = JWT::encode($payload, $key, $authConfig["jwt_alg"]);

            $_SESSION[$authConfig["access_token_session_name"]] = $token;


            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }


    public function doAuth(): bool
    {
        try {
            $authConfig = Config::getInstance()->getAllConfig("auth");
            $token = $_SESSION[$authConfig["access_token_session_name"]] ?? false;
            if (!$token) {
                return false;
            }

            $payLoad = JWT::decode($token, new Key($authConfig["jwt_key"], $authConfig["jwt_alg"]));
            $this->isAuth = true;
            $user = User::query()->find($payLoad->id);
            if (!$user) {
                return false;
            }

            $this->userModel = $user;

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $userId
     * @return Auth
     */
    public function createUSer($userId): static
    {
        $user = User::find($userId);
        $this->userModel = $user;
        self::$auth = $this;
        return $this;
    }

    /**
     * @return Auth|null
     */
    public static function getInstance(): ?Auth
    {
        if (self::$auth == null)
            self::$auth = new self();
        return self::$auth;
    }


    public function logout()
    {
        $authConfig = Config::getInstance()->getAllConfig("auth");
        unset($_SESSION[$authConfig["access_token_session_name"]]);
        $this->userModel = null;
        $this->isAuth = false;
    }

}