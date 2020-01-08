<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\Repository;
use app\models\entities\Cart;

class CartRepository extends Repository
{
    public function getCart($session) {
        $sql = "SELECT p.id id_prod, c.id id_cart, p.name, p.link, p.price FROM cart c,products p WHERE c.product_id=p.id AND session_id = :session";
        return App::call()->db->queryAll($sql, ['session' => $session]);
    }

    public function getTableName()
    {
        return "cart";
    }

    public function getEntityClass() {
        return Cart::class;
    }
}
