<?php


namespace app\models\entities;


use app\models\Model;

class Orders extends Model
{
    protected $session_id;
    protected $login;
    protected $name;
    protected $email;
    protected $status;

    protected $props = [
        'session_id' => false,
        'login' => false,
        'name' => false,
        'email' => false,
        'status' => false
    ];

    public function __construct($session_id = null, $login = null, $name = null, $email = null, $status =
    0)
    {
        $this->session_id = $session_id;
        $this->login = $login;
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
    }
}