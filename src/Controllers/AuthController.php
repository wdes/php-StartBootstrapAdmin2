<?php

declare(strict_types = 1);

namespace WdesAdmin\Controllers;

use WdesAdmin\Models\AdminUser;
use WdesAdmin\AbstractController;
use WdesAdmin\Flash;
use WdesAdmin\Response;
use WdesAdmin\Session;
use WdesAdmin\Template;
use WdesAdmin\WdesAdmin;

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
        $this->addHtml(
            Template::render('login', [
                'username' => '',
                'password' => '',
                ]
            )
        );
        return $this->response;
    }

    public function logout(): Response
    {
        Session::destroy();
        Flash::addMessage(Flash::LEVEL_INFO, 'Bye !');
        $this->addHtml(
            Template::render('login', [
                'username' => '',
                'password' => '',
                ]
            )
        );
        return $this->response;
    }

    public function doLogin(): Response
    {
        $password = $_POST['password'] ?? '';
        $username = $_POST['username'] ?? '';

        $user = AdminUser::findByUsername($username);
        if ($user !== null && WdesAdmin::passwordMatch($user->getPassword(), $password)) {
            Flash::addMessage(Flash::LEVEL_INFO, 'Welcome back !');
            Session::set('logged_in', true);
            Session::set('user', [
                    'username' => $user->getUsername(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                ]
            );
            $this->redirect('/');
            return $this->response;
        }

        Flash::addMessage(Flash::LEVEL_DANGER, 'Unable to validate your credentials !');

        $this->addHtml(
            Template::render('login', [
                'username' => $username,
                'password' => $password,
            ])
        );
        return $this->response;
    }

    public function register(): Response
    {
        $this->addHtml(
            Template::render('register', [
                'first_name' => '',
                'last_name' => '',
                'username' => '',
                'password' => '',
                'password_check' => '',
            ])
        );
        return $this->response;
    }

    public function doRegister(): Response
    {
        $password1 = $_POST['password'] ?? '';
        $password2 = $_POST['password_check'] ?? '';
        $firstName = $_POST['first_name'] ?? '';
        $lastName  = $_POST['last_name'] ?? '';
        $username  = $_POST['username'] ?? '';

        $invalid = false;

        if ($password1 !== $password2) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'The passwords do not match');
            $invalid = true;
        }

        if ($password1 === $password2 && strlen($password1) < 10) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'The password is not secure, must be at least 10 chars long !');
            $invalid = true;
        }

        if (strlen($firstName) > 255) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'Invalid first name');
            $invalid = true;
        }
        if (strlen($lastName) > 255) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'Invalid last name');
            $invalid = true;
        }
        if (strlen($username) > 255 && strlen($username) < 2) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'Invalid username');
            $invalid = true;
        }

        if (! $invalid && AdminUser::findByUsername($username) !== null) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'Username already taken !');
            $invalid = true;
        }

        if ($invalid) {
            $this->addHtml(
                Template::render('register', [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'username' => $username,
                    'password' => $password1,
                    'password_check' => $password2,
                    ]
                )
            );
            return $this->response;
        }

        if ($password1 === $password2) {
            $newUser = AdminUser::create(
                $username,
                $firstName === '' ? null : $firstName,
                $lastName === '' ? null : $lastName,
                WdesAdmin::cryptPassword($password1)
            );
            if ($newUser->save()) {
                $this->redirect('/');
                return $this->response;
            }
            Flash::addMessage(Flash::LEVEL_DANGER, 'Unable to create the user !');
        }

        $this->addHtml(
            Template::render('register', [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'password' => $password1,
                'password_check' => $password2,
                ]
            )
        );
        return $this->response;
    }

}
