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
    /** @var string */
    public $title = 'WdesAdmin';

    /** @var array<string,mixed> */
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function render(string $template, array $data = []): void
    {
        echo Template::render($template, $data);
    }

    public function buildRoute(string $route): string
    {
        return 'index.php?route=' . $route;
    }

    public function route(string $route): void
    {
        echo $this->buildRoute($route);
    }

    public function debugData(): void
    {
        var_dump($this->data);// phpcs:ignore Squiz.PHP.DiscouragedFunctions.Found
    }

    public function safe(string $value): string
    {
        return htmlspecialchars($value, ENT_COMPAT | ENT_HTML5);
    }

    public function value(string $key): void
    {
        echo $this->safe($this->data[$key] ?? '');
    }

    public function checked(string $key): void
    {
        echo ($this->data[$key] ?? '') === 'true' ? 'checked' : '';
    }

    public function getFlashMessages(): array
    {
        $messages = Flash::getMessages();
        Flash::clear();// Empty them
        return $messages;
    }

    /**
     * @todo move logic to keep in sync with the Session::set code
     */
    public function getUserDisplayName(): string
    {
        $user         = Session::get('user', []);
        $displayName  = $user['first_name'] ?? '';
        $displayName .= ' ';
        $displayName .= $user['last_name'] ?? '';
        if (empty(trim($displayName, ' '))) {
            $displayName = $user['username'] ?? '__INVALID__';
        }

        return $displayName;
    }

    public function getSiteName(): string
    {
        return WdesAdmin::getSiteName();
    }

    public function equalsCurrentRoute(string $route): bool
    {
        return $_GET['route'] === $route;
    }

    public function getUserMenus(): array
    {
        $menusOut = [];
        foreach (WdesAdmin::getModules() as $module) {
            $menus = $module->registerUserMenu();
            if ($menus === null) {
                continue;
            }
            array_push($menusOut, ...$menus);
        }
        return $menusOut;
    }

    public function getSidebarMenus(): array
    {
        $menusOut = [];
        foreach (WdesAdmin::getModules() as $module) {
            $menus = $module->registerSidebar();
            if ($menus === null) {
                continue;
            }
            array_push($menusOut, ...$menus);
        }
        return $menusOut;
    }

    public function getDashboardItems(): array
    {
        $items = [];
        foreach (WdesAdmin::getModules() as $module) {
            $items = $module->registerDashboard();
            if ($items === null) {
                continue;
            }
            array_push($items, $items);
        }
        return $items;
    }
}
