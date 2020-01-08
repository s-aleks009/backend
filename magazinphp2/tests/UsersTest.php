<?php

use app\models\entities\Users;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testUsersConstruct()
    {
        $login = "login";
        $password = "password";
        $name = "name";
        $is_admin = "is_admin";
        $hash = "hash";
        $users = new Users($login, $password, $name, $is_admin, $hash);
        $this->assertEquals($login, $users->login);
        $this->assertEquals($password, $users->password);
        $this->assertEquals($name, $users->name);
        $this->assertEquals($is_admin, $users->is_admin);
        $this->assertEquals($hash, $users->hash);
    }

    public function testUsersNamespace()
    {
        $this->assertTrue(strpos(Users::class, "app\\") === 0);
        $this->assertTrue(array_slice(explode("\\", Users::class), 1, 1) === ['models']);
        $this->assertTrue(array_slice(explode("\\", Users::class), 2, 1) === ['entities']);
        $this->assertTrue(substr_count(Users::class, "\\") === 3);
    }
}