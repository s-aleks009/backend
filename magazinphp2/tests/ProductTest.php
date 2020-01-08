<?php

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductConstruct()
    {
        $name = "name";
        $price = "price";
        $link = "link";
        $product = new Product($name, $price, $link);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($link, $product->link);
    }

    public function testProductNamespace()
    {
        $this->assertTrue(strpos(Product::class, "app\\") === 0);
        $this->assertTrue(array_slice(explode("\\", Product::class), 1, 1) === ['models']);
        $this->assertTrue(array_slice(explode("\\", Product::class), 2, 1) === ['entities']);
        $this->assertTrue(substr_count(Product::class, "\\") === 3);
    }
}