<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Cart;

class CartController extends Controller
{
    protected $defaultAction = 'cart';

    public function actionCart() {
        $cart = App::call()->cartRepository->getCart(session_id());
        echo $this->render('cart', [
            'products' => $cart,
            'auth' => App::call()->usersRepository->isAuth()
        ]);
    }

    public function actionAddToCart() {
        $id = App::call()->request->getParams()['id'];

        $cart = new Cart(session_id(), $id);
        App::call()->cartRepository->save($cart);

        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'count' => App::call()->cartRepository->getCountWhere('session_id', session_id())
        ]);
        die();
    }

    public function actionDelete() {
        $id = App::call()->request->getParams()['id'];
        $session = session_id();
        $cart = App::call()->cartRepository->getOne($id);
        if ($session == $cart->session_id) {
            App::call()->cartRepository->delete($cart);
        }

        echo json_encode([
            'response' => 'ok',
            'count' => App::call()->cartRepository->getCountWhere('session_id', session_id())
        ]);
        die();
    }
}


