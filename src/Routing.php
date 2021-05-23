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
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    public static function manage(string $route): void
    {
        $routes = require __DIR__ . DIRECTORY_SEPARATOR . 'routes.php';

        $requestMethod = filter_input(
            \INPUT_SERVER, 'REQUEST_METHOD', \FILTER_SANITIZE_SPECIAL_CHARS
        );

        $routeExists = isset($routes[$route]);

        if (! $routeExists) {
            $route = '/404';
            $requestMethod = 'GET';
        }

        $routeMethodExists = isset($routes[$route][$requestMethod]);

        if (! $routeMethodExists) {
            $route = '/405';
            $requestMethod = 'GET';
        }

        $routeData = $routes[$route][$requestMethod];
        /** @var AbstractController $controller */
        $controller = new $routeData[0]();
        if (! $controller->authorized()) {
            $response = new Response();
            $response->addHeader('Location', 'index.php?route=/login');
            $response->send();
            return;
        }
        /** @var Response $response */
        $response = $controller->{$routeData[1]}();
        $response->send();
    }
}
