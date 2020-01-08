<?php

use app\models\entities\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCartConstruct()
    {
        $session_id = "session_id";
        $product_id = "product_id";
        $cart = new Cart($session_id, $product_id);
        $this->assertEquals($session_id, $cart->session_id);
        $this->assertEquals($product_id, $cart->product_id);
    }

    public function testCartNamespace()
    {
        $this->assertTrue(strpos(Cart::class, "app\\") === 0);
        $this->assertTrue(array_slice(explode("\\", Cart::class), 1, 1) === ['models']);
        $this->assertTrue(array_slice(explode("\\", Cart::class), 2, 1) === ['entities']);
        $this->assertTrue(substr_count(Cart::class, "\\") === 3);
    }
}