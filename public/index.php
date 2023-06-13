<?php
    declare(strict_types=1);

    $dirname = __DIR__ . DIRECTORY_SEPARATOR;
    require_once $dirname . '../vendor/autoload.php';

    use app\core\Application;

    $app = new Application(dirname(__DIR__) .DIRECTORY_SEPARATOR);

    $app->router->get('/', 'home');

    $app->router->get('/customers', 'customers');
    $app->router->get('/contact', 'contact');

    $app->run();