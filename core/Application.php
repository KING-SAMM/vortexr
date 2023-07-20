<?php

declare(strict_types=1);

namespace app\core;

// use app\core\router;

/**
 * class Application
 * 
 * @author KC Samm <kcsamm@studioeternal.net>
 * @package app\core
 */

 class Application 
 {
    # Global variables
    public static string $ROOT;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public function __construct(string $rootPath) 
    {
        self::$ROOT = $rootPath;
        self::$app = $this;
        $this->request =  new Request();
        $this->response =  new Response();
        $this->router =  new Router($this->request, $this->response);
    }

    public function run() 
    {
        # Detaermines/resolves which router callback to execute
        echo $this->router->resolve();
    }
 }