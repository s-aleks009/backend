<?php


namespace app\controllers;


use app\engine\App;
use app\interfaces\IRenderer;

class Controller implements IRenderer
{
    protected $action = '';
    protected $defaultAction = '';
    protected $actionId = '';
    protected $layout = 'main';
    protected $useLayout = true;
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null, $id = null) {
        if (!is_null($id)) {
            $this->actionId = $id;
        }
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "Ошибка: нет такого action";
        }
    }

    public function render($template, $params = []) {   //Собирает общую страницу
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', [
                    'count' =>App::call()->cartRepository->getCountWhere('session_id', session_id()),
                    'isAdmin' => App::call()->usersRepository->isAdmin()
                ]),
                'content' => $this->renderTemplate($template, $params),
                'auth' => App::call()->usersRepository->isAuth(),
                'username' => App::call()->usersRepository->getName()
            ]);
        } else {
            return $this->renderTemplate($template, $params = []);
        }
    }

    public function renderTemplate($template, $params = []) {   //Собирает части страниц по отдельности
       return $this->renderer->renderTemplate($template, $params);
    }
}