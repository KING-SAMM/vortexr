<?php
    declare(strict_types=1);

    $dirname = __DIR__ . DIRECTORY_SEPARATOR;
    require_once $dirname . '../vendor/autoload.php';

    use App\Controllers\SiteController;
    use App\Core\Application;

    $app = new Application(dirname(__DIR__) .DIRECTORY_SEPARATOR);

    $app->router->get('/', [SiteController::class, "home"]);

    $app->router->get('/profile', 'profile');
    $app->router->get('/customers', 'customers');
    $app->router->get('/gallery', 'gallery');
    $app->router->get('/contact', [SiteController::class, "contact"]);
    $app->router->post('/contact', [SiteController::class, "handleContact"]);

    $app->run();