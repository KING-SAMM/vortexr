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

    public function get(string $path, callable $callback)
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
        if ($callback === false) 
        {
            echo "Page not found";
            exit;
        }
        echo call_user_func($callback);
    }
 }