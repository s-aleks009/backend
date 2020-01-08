<?php


namespace app\models\entities;


use app\models\Model;

class Product extends Model
{
    protected $name;
    protected $price;
    protected $link;

    protected $props = [
        'name' => false,
        'price' => false,
        'link' => false
    ];

    public function __construct($name = null, $price = null, $link = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->link = $link;
    }
}
