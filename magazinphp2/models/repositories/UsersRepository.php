<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Users;

class UsersRepository extends Repository
{
    public function isAuth()
    {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user = $this->getWhereOne('hash', $hash);
            if (!empty($user)) {
                $_SESSION['login'] = $user->login;
            }
        }
        return isset($_SESSION['login']) ? true : false;
    }

    public function getName()
    {
        return $_SESSION['login'];
    }

    public function auth($login, $password)
    {
        $user = $this->getWhereOne('login', $login);

        if (password_verify($password, $user->password)) {
            $_SESSION['login'] = $login;
            return true;
        }
    }

    public function isAdmin()
    {
        $login = $_SESSION['login'];
        $user = $this->getWhereOne('login', $login);
        return $user->is_admin;
    }

    public function getTableName()
    {
        return "users";
    }

    public function getEntityClass()
    {
        return Users::class;
    }
}
