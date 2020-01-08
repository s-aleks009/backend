<?php


namespace app\engine;


use app\models\repositories\{CartRepository, ProductRepository, UsersRepository};
use app\traits\TSingleton;

/**
 * Class App
 * @property Request $request
 * @property CartRepository $cartRepository
 * @property UsersRepository $usersRepository
 * @property ProductRepository $productRepository
 * @property Db $db
 */
class App
{
    use TSingleton;

    public $config;
    private $components;
    private $controller;
    private $action;
    private $actionId;

    public static function call()
    {
        return static::getInstance();
    }

    public function runController()
    {

        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();
        $this->actionId = $this->request->getActionId();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action, $this->actionId);
        } else {
            echo "Не правильный контроллер";
        }
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    function __get($name)
    {
        return $this->components->get($name);
    }
}