<?php

declare(strict_types = 1);

namespace WdesAdminModule\profile;

use WdesAdmin\AbstractModule;
use WdesAdmin\Models\AdminUser;
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
                Routing::METHOD_POST => [ProfileController::class, 'updateProfile'],
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
        return [
            [
                'heading' => 'Collapse 1-2',
            ],
            [
                'collapse' => [
                    'text' => 'Collapse 1',
                    'icon' => 'mdi mdi-account',
                    'childs' => [
                        [
                            'header-text' => 'Header 1',
                            'links' => [
                                [
                                    'route' => '/user/profile',
                                    'text' => 'Profile',
                                ],
                                [
                                    'route' => '/example-2',
                                    'text' => 'Example 2',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'divider' => true,
            ],
            [
                'collapse' => [
                    'text' => 'Collapse 2',
                    'icon' => 'mdi mdi-desktop-mac-dashboard',
                    'childs' => [
                        [
                            'header-text' => 'Header 2',
                            'links' => [
                                [
                                    'route' => '/example-3',
                                    'text' => 'Example 3',
                                ],
                                [
                                    'route' => '/example-4',
                                    'text' => 'Example 2',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }

    public function registerDashboard(): ?array
    {
        $nbrUsers = AdminUser::count();
        return [
            'cards' => [
                [
                    'icon' => 'mdi mdi-account mdi-36px',
                    'color' => 'primary',
                    'text' => 'Users',
                    'text-color' => 'info',
                    'value' => $nbrUsers,
                ]
            ]
        ];
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
