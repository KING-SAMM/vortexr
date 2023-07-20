<?php

namespace app\controllers;

use app\core\Application;

/**
 * class SiteController
 * 
 * @author KC Samm <kcsamm@studioeternal.net>
 * @package app\controllers
 */

class SiteController 
{
    public static function home()
    {
        # pass data to home view
        $params = [
            "name" => "KC Samm"
        ];
        return Application::$app->router->renderView('home', $params);
    }

    public static function contact()
    {
        return Application::$app->router->renderView('contact');
    }

    public static function handleContact()
    {
        return "Handling submitted data";
    }
}