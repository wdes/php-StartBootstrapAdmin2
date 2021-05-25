<?php

declare(strict_types = 1);

namespace WdesAdminModule\profile\Controllers;

use WdesAdmin\AbstractController;
use WdesAdmin\Flash;
use WdesAdmin\Models\AdminUser;
use WdesAdmin\Response;
use WdesAdmin\Session;
use WdesAdmin\WdesAdmin;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class ProfileController extends AbstractController
{

    public function authorized(): bool
    {
        return true;
    }

    public function profile(): Response
    {
        $user = WdesAdmin::getCurrentUser();
        $this->addHtml(
            $this->render(
                '@[profile]/profile', [
                    'username' => $user->getUsername(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'password' => '',
                    'password_check' => '',
                ]
            )
        );
        return $this->response;
    }

    public function updateProfile(): Response
    {
        $password1 = $_POST['password'] ?? '';
        $password2 = $_POST['password_check'] ?? '';
        $firstName = $_POST['first_name'] ?? '';
        $lastName  = $_POST['last_name'] ?? '';
        $hasPassword = $password1 !== '';

        $invalid = false;

        if ($hasPassword && $password1 !== $password2) {
            Flash::addMessage(Flash::LEVEL_DANGER, 'The passwords do not match');
            $invalid = true;
        }

        if ($hasPassword && $password1 === $password2 && strlen($password1) < 10) {
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

        /** @var AdminUser $user */
        $user = AdminUser::findByUsername(Session::get('user')['username']);

        if (!$invalid) {
            $user->setFirstName($firstName === '' ? null : $firstName);
            $user->setLastName($lastName === '' ? null : $lastName);
            if ($hasPassword) {
                $user->setPassword(
                    WdesAdmin::cryptPassword($password1)
                );
            }
            if ($user->hasChanges()) {
                if ($user->update()) {
                    Flash::addMessage(Flash::LEVEL_SUCCESS, 'Profile updated !');
                    Session::set('user', [
                            'username' => $user->getUsername(),
                            'first_name' => $user->getFirstName(),
                            'last_name' => $user->getLastName(),
                        ]
                    );
                } else {
                    Flash::addMessage(Flash::LEVEL_DANGER, 'Could not update the profile !');
                }
            } else {
                Flash::addMessage(Flash::LEVEL_INFO, 'No changes to apply');
            }
        }

        $this->addHtml(
            $this->render(
                '@[profile]/profile', [
                    'username' => $user->getUsername(),
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => $password1,
                    'password_check' => $password2,
                ]
            )
        );
        return $this->response;
    }

}
