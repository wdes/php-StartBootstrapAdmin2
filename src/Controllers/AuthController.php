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
            'remember_me' => $_POST['remember_me'] ?? '',
        ]));
        return $this->response;
    }

    public function register(): Response
    {
        $this->addHtml(Template::render('register', [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name' => $_POST['last_name'] ?? '',
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'password_check' => $_POST['password_check'] ?? '',
        ]));
        return $this->response;
    }
}
