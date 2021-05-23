<?php

declare(strict_types = 1);

use WdesAdmin\Controllers\AuthController;
use WdesAdmin\Controllers\ErrorController;
use WdesAdmin\Controllers\HomeController;
use WdesAdmin\Routing;

return [
    '/' => [
        Routing::METHOD_GET => [HomeController::class, 'index']
    ],
    '/404' => [
        Routing::METHOD_GET => [ErrorController::class, 'error404'],
    ],
    '/405' => [
        Routing::METHOD_GET => [ErrorController::class, 'error405'],
    ],
    '/login' => [
        Routing::METHOD_GET => [AuthController::class, 'login'],
        Routing::METHOD_POST => [AuthController::class, 'doLogin'],
    ],
    '/logout' => [
        Routing::METHOD_GET => [AuthController::class, 'logout'],
    ],
    '/register' => [
        Routing::METHOD_GET => [AuthController::class, 'register'],
        Routing::METHOD_POST => [AuthController::class, 'doRegister'],
    ],
];
