<?php

declare(strict_types = 1);

namespace WdesAdmin;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class Routing
{
    public static function manage(string $route): void
    {
        $routes = require __DIR__ . DIRECTORY_SEPARATOR . 'routes.php';
        $route = isset($routes[$route]) ? $route : '/404';
        $routeData = $routes[$route];
        /** @var AbstractController $controller */
        $controller = new $routeData[0]();
        if (! $controller->authorized()) {
            header('Location: index.php?route=/login');
            return;
        }
        /** @var Response $response */
        $response = $controller->{$routeData[1]}();
        $response->send();
    }
}
