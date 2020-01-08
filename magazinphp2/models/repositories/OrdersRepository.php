<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\Repository;
use app\models\entities\Orders;

class OrdersRepository extends Repository
{
    public function getOrdersAdmin() {
        $sql = "SELECT id, name, email FROM `orders` WHERE status <> 2";
        return App::call()->db->queryAll($sql);
    }

    public function getOrdersUser($login) {
        if ($login !== 'No Auth') {
            $sql = "SELECT o.id, p.name, p.price, s.name AS status FROM orders AS o
	                INNER JOIN cart AS c ON o.session_id = c.session_id
	                INNER JOIN status AS s ON o.status = s.id
	                INNER JOIN products AS p ON c.product_id = p.id WHERE o.login = :login;";
            return App::call()->db->queryAll($sql, ['login' => $login]);
        } else {
            $sql = "SELECT o.id, p.name, p.price, s.name AS status FROM orders AS o
	                INNER JOIN cart AS c ON o.session_id = c.session_id
	                INNER JOIN status AS s ON o.status = s.id
	                INNER JOIN products AS p ON c.product_id = p.id WHERE o.session_id = :session_id;";
            return App::call()->db->queryAll($sql, ['session_id' => session_id()]);
        }
    }

    public function infoOrders($id) {
        $sql = "SELECT o.id, p.name, p.price FROM orders AS o
	                INNER JOIN cart AS c ON o.session_id = c.session_id
	                INNER JOIN products AS p ON c.product_id = p.id WHERE o.id = :id;";
        return App::call()->db->queryAll($sql, ['id' => $id]);
    }

    public function completeOrders() {
        $sql = "SELECT id, name, email FROM `orders` WHERE status = 2";
        return App::call()->db->queryAll($sql);
    }

    public function getTableName()
    {
        return "orders";
    }

    public function getEntityClass() {
        return Orders::class;
    }
}