<?php
declare(strict_types=1);

namespace App\Core;

/**
 * class Router
 * 
 * @author KC Samm <kcsamm11@studioeternal.net>
 * @package App\Core
 */

 class Router 
 {
    protected array $routes = [];

    /**
     * Router constructor
     * 
     * @param \app\core\Request $request
     * @param \app\core\Response $response
     */
    public function __construct
    (
        public Request $request,
        public Response $response
    )
    {}

    public function get(string $path, array|callable|string $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, array|callable|string $callback)
    {
        $this->routes['post'][$path] = $callback;
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
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        # If $callback is a string and not expected 
        # function/closure render the view
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }

        # We need an instance of the class (i.e $callback[0]) and then
        # assign it back to the $callback in order to avoid
        # the "Using $this when not in object context" error
        # that shows up when we use '$this' keyword within
        # SiteController class
        if(is_array($callback))
        {
            $callback[0] = new $callback[0]();
        }
        
        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view, array $params = [])
    {
        # Render views within the layout content
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);

        // include_once Application::$ROOT . "views/$view.php";
    }

    public function renderViewContent(string $viewContent)
    {
        # Render views within the layout content
        $layoutContent = $this->layoutContent();
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

    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start(); 

        include_once Application::$ROOT . "views/$view.php";

        return ob_get_clean(); 
    }
 }