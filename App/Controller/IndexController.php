<?php

namespace RemoteConfig\App\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use RemoteConfig\App\Model\User;
use RemoteConfig\Classes\Auth;
use RemoteConfig\Classes\Exception\ValidatorNotFoundException;
use RemoteConfig\Classes\Redirect;
use RemoteConfig\Classes\Request;
use RemoteConfig\Classes\ViewEngine;

class IndexController
{
    public function getIndex(): ViewEngine
    {
        var_dump($_SESSION);
        die();
        return view("index", compact("name"));
    }

    public function getSignUp(): ViewEngine
    {
        $title = "ثبت نام";
        return view("auth>signUp", compact("title"));
    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function postSignUp(): Redirect
    {
        Request::getInstance()->validatePostsAndFiles("signUpValidator");

        $user = User::create(request()->getValidated());
        if ($user) {
            return redirect(route('login'))->withMessage("login", "ورود با موفقیت انجام شد.");
        }
        return redirect(back())->with("error", "متاسفانه کاربر ایجاد نشد.");

        // TODO:: برسی فعال بودن تیک قوانین ما
    }

    /**
     * @return ViewEngine
     */
    public function getLogin(): ViewEngine
    {
        $title = "ورود";
        return view("auth>login", compact("title"));
    }


    /**
     * @throws ValidatorNotFoundException
     */
    public function postLogin()
    {
        request()->validatePostsAndFiles("auth" . DIRECTORY_SEPARATOR . "loginValidator");
        $auth = new Auth();
        $loginStatus = $auth->doLogin(
            Request::getInstance()->getValidated()["email"],
            Request::getInstance()->getValidated()["password"],
            Request::getInstance()->getValidated()["isLong"] == "1"
        );
        if (!$loginStatus) {
            return redirect(back())->with("error", "نام کاربری و رمز عبور همخوانی ندارد.");
        }
        return redirect(route("panel"))->withMessage('message', "ورود موفقیت آمیز بود.");
    }


}