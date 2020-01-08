<?php


namespace app\controllers;


use app\engine\App;

class ProductController extends Controller
{
    protected $defaultAction = 'index';

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = App::call()->productRepository->getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionItem() {
        $product = App::call()->productRepository->getOne($this->actionId);
        echo $this->render('item', ['product' => $product]);
    }
}