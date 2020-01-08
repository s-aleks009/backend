<?php


namespace app\models\entities;


use app\models\Model;

class Users extends Model
{
    protected $login;
    protected $password;
    protected $name;
    protected $is_admin;
    protected $hash;

    protected $props = [
        'login' => false,
        'password' => false,
        'name' => false,
        'is_admin' => false,
        'hash' => false
    ];

    public function __construct($login = null, $password = null,
                                $name = null, $is_admin = null, $hash = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->is_admin = $is_admin;
        $this->hash = $hash;
    }
}
