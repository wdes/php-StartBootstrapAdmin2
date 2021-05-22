<?php

declare(strict_types = 1);

use WdesAdmin\Controllers\AuthController;
use WdesAdmin\Controllers\ErrorController;
use WdesAdmin\Controllers\HomeController;

return [
    '/' => [HomeController::class, 'index'],
    '/404' => [ErrorController::class, 'error404'],
    '/login' => [AuthController::class, 'login'],
];
