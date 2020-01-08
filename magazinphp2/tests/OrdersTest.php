<?php

use app\models\entities\Orders;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{
    public function testOrdersConstruct()
    {
        $session_id = "session_id";
        $login = "login";
        $name = "name";
        $email = "email";
        $status = "status";
        $orders = new Orders($session_id, $login, $name, $email, $status);
        $this->assertEquals($session_id, $orders->session_id);
        $this->assertEquals($login, $orders->login);
        $this->assertEquals($name, $orders->name);
        $this->assertEquals($email, $orders->email);
        $this->assertEquals($status, $orders->status);
    }

    public function testOrdersNamespace()
    {
        $this->assertTrue(strpos(Orders::class, "app\\") === 0);
        $this->assertTrue(array_slice(explode("\\", Orders::class), 1, 1) === ['models']);
        $this->assertTrue(array_slice(explode("\\", Orders::class), 2, 1) === ['entities']);
        $this->assertTrue(substr_count(Orders::class, "\\") === 3);
    }
}