<?php
    declare(strict_types=1);

    $dirname = __DIR__ . DIRECTORY_SEPARATOR;
    require_once $dirname . '../vendor/autoload.php';

    use app\core\Application;

    $app = new Application();

    $app->router->get('/', function() {
        return "<h1>Hello world</h1><br><p><a href='/customers'>See all customers</a></p>";
    });

    $app->router->get('/customers', function() {
        return "<h1>All customers</h1>";
    });

    $app->run();