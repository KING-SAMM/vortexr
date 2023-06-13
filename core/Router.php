<?php
declare(strict_types=1);

namespace app\core;

/**
 * class Router
 * 
 * @author KC Samm <kcsamm11@studioeternal.net>
 * @package app\core
 */

 class Router 
 {
    protected array $routes = [];

    public function __construct(public \app\core\Request $request)
    {}

    public function get(string $path, callable|string $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        # To resolve we need the request uri, and 
        # from that we create a Request class with methods getPath and getMethod

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        # If $callback doen not exist
        if ($callback === false) 
        {
            # Set appropriate status code for not found routes
            Application::$app->response->setStatusCode(404);
            return "Page not found";
        }

        # If $callback is a string and not expected 
        # function/closure render the view
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView(string $view)
    {
        # Render views within the layout content
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);

        // include_once Application::$ROOT . "views/$view.php";
    }

    protected function layoutContent()
    {
        # Turn on output buffering
        ob_start(); 

        include_once Application::$ROOT . "views/layouts/main.php";

        # Get current buffer contents and delete current output buffer
        return ob_get_clean(); 
    }

    protected function renderOnlyView($view)
    {
        ob_start(); 

        include_once Application::$ROOT . "views/$view.php";

        return ob_get_clean(); 
    }
 }