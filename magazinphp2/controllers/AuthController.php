<?php


namespace app\controllers;


use app\engine\App;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = App::call()->request->getParams()['login'];
        $password = App::call()->request->getParams()['password'];
        if (!App::call()->usersRepository->auth($login, $password)) {
            Die("Логин или пароль не верный!");
        } else {
            $hash = uniqid(rand(), true);
            $login = App::call()->request->getParams()['login'];
            $user = App::call()->usersRepository->getWhereOne('login', $login);
            if ($login == $user->login) {
                $user->hash = $hash;
                App::call()->usersRepository->update($user);
            }
            setcookie("hash", $hash, time() + 3600, "/");
            header('Location: /' /*. $_SERVER['HTTP_REFERER']*/);
            exit();
        }
    }

    public function actionLogout() {
        session_regenerate_id();
        session_destroy();
        setcookie("hash", "", time() - 3600, "/");
        header('Location: /');
        exit();
    }
}