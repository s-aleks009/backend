<?php
use app\engine\{Db, Request};
use app\models\repositories\{CartRepository, OrdersRepository, ProductRepository, UsersRepository};

return [
    'root_dir' => dirname(__DIR__),
    'templates_dir' => dirname(__DIR__) . "/templates/",
    'controllers_namespaces' => "app\controllers\\",
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3307',
            'login' => 'root',
            'password' => '',
            'database' => 'magazinphp2',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'usersRepository' => [
            'class' => UsersRepository::class
        ]
    ]
];