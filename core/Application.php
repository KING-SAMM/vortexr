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
    public Router $router;
    public Request $request;
    public function __construct() 
    {
        $this->request =  new Request();
        $this->router =  new Router($this->request);
    }

    public function run() 
    {
        # Detaermines/resolves which router callback to execute
        $this->router->resolve();
    }
 }