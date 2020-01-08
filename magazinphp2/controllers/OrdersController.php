<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Orders;

class OrdersController extends Controller
{
    protected $defaultAction = 'orders';

    public function actionBuy() {
        if ($_SESSION['login']) {
            $login = $_SESSION['login'];
        } else {
            $login = 'No Auth';
        }

        $name = App::call()->request->getParams()['name'];
        $email = App::call()->request->getParams()['email'];

        $orders = new Orders(session_id(), $login, $name, $email);
        App::call()->ordersRepository->save($orders);

        $ordersUser = App::call()->ordersRepository->getOrdersUser($login);
        rsort($ordersUser);
        session_regenerate_id();
        echo $this->render('ordersUser', ['ordersUser' => $ordersUser]);
    }

    public function actionOrders() {
        $login = $_SESSION['login'];

        $ordersUser = App::call()->ordersRepository->getOrdersUser($login);
        rsort($ordersUser);
        echo $this->render('ordersUser', ['ordersUser' => $ordersUser]);
    }

    public function actionGet() {
        $getOrders = App::call()->ordersRepository->getOrdersAdmin();
        rsort($getOrders);
        echo $this->render('ordersAdmin', [
            'getOrders' => $getOrders,
            'isAdmin' => App::call()->usersRepository->isAdmin()
        ]);
    }

    public function actionInfo() {
        $infoOrders = App::call()->ordersRepository->infoOrders($this->actionId);
        echo $this->render('ordersInfo', [
            'infoOrders' => $infoOrders,
            'isAdmin' => App::call()->usersRepository->isAdmin()
        ]);
    }

    public function actionSetStatus() {
        $id = App::call()->request->getParams()['id'];
        $status = App::call()->request->getParams()['status'];

        $orders = App::call()->ordersRepository->getWhereOne('id', $id);
        $orders->status = $status;
        App::call()->ordersRepository->update($orders);

        header('Content-Type: application/json');
        echo json_encode(['response' => 'ok']);
        die();
    }

    public function actionGetStatus() {
        $id = App::call()->request->getParams()['id'];

        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'status' => App::call()->ordersRepository->getStatusWhere('id', $id)
        ]);
        die();
    }

    public function actionComplete() {
        $getComplete = App::call()->ordersRepository->completeOrders();
        rsort($getComplete);
        echo $this->render('ordersComplete', [
            'getComplete' => $getComplete,
            'isAdmin' => App::call()->usersRepository->isAdmin()
        ]);
    }
}