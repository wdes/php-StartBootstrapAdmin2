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

abstract class AbstractController
{
    /** @var Response */
    protected $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function addHtml(string $html): void
    {
        $this->response->addContents($html);
    }

    public function redirect(string $route): void
    {
        $this->response->addHeader('Location', 'index.php?route=' . $route);
    }

    /**
     * @var string template name in templates/ without .php at the end
     */
    public function render(string $template, array $data = []): string
    {
        return Template::render(
            $template,
            $data
        );
    }


    public function authorized(): bool
    {
        return Session::get('logged_in', false) === true;
    }

}
