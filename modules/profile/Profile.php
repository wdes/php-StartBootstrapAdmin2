<?php

declare(strict_types = 1);

namespace WdesAdminModule\profile;

use WdesAdmin\AbstractModule;
use WdesAdmin\ModuleInterface;
use WdesAdmin\Routing;
use WdesAdminModule\profile\Controllers\ProfileController;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class Profile extends AbstractModule implements ModuleInterface
{

    public function __construct()
    {
    }

    public function loadConfig(array $config): void
    {
    }

    public function registerRoutes(): ?array
    {
        return [
            '/user/profile' => [
                Routing::METHOD_GET => [ProfileController::class, 'profile'],
            ],
        ];
    }

    public function registerUserMenu(): ?array
    {
        return [
            [
                'route' => '/user/profile',
                'icon' => 'account',
                'text' => 'Account',
            ],
            [
                'divider' => true,
            ]
        ];
    }

    public function registerSidebar(): ?array
    {
        return null;
    }

    public function registerTopbar(): ?array
    {
        return null;
    }

    public function requiresPhpExtensions(): ?array
    {
        return [
            'ldap'
        ];
    }

}
