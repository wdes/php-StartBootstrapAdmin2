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

class TemplateContext
{
    public $title = 'WdesAdmin';

    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function render(string $template, array $data = []): void
    {
        echo Template::render($template, $data);
    }

    public function route(string $route): void
    {
        echo 'index.php?route=' . $route;
    }

    public function debugData(): void
    {
        var_dump($this->data);
    }

    public function value(string $key): void
    {
        echo htmlspecialchars($this->data[$key] ?? '', ENT_COMPAT | ENT_HTML5);
    }
}
