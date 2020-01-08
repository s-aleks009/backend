<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Product;

class ProductRepository extends Repository
{
    public function getTableName() {
        return "products";
    }

    public function getEntityClass() {
        return Product::class;
    }
}
