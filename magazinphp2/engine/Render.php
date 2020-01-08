<?php


namespace app\engine;


use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params = []) {   //Собирает части страниц по отдельности
        ob_start();
        extract($params);
        $templateName = App::call()->config['templates_dir'] . $template . ".php";
        if (file_exists($templateName)) {
            include $templateName;
        }
        return ob_get_clean();
    }
}