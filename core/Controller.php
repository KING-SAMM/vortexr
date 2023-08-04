<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Application;

class Controller 
{

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}