<?php

declare(strict_types = 1);

namespace WdesAdmin\Controllers;

use WdesAdmin\AbstractController;
use WdesAdmin\Response;
use WdesAdmin\Template;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class AuthController extends AbstractController
{
    public function authorized(): bool
    {
        return true;
    }

    public function login(): Response
    {
        $this->addHtml(Template::render('login', [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
        ]));
        return $this->response;
    }
}