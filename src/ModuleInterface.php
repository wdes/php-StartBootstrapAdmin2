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

interface ModuleInterface
{

    /**
     * An empty constructor
     *
     * @return void
     */
    public function __construct();

    /**
     * Called at module init with the config given for the module
     *
     * At this point the required php extensions can be not loaded (requiresPhpExtensions)
     *
     * @return array<string,mixed>
     */
    public function loadConfig(array $config): void;

    /**
     * Register the routes for the module
     *
     * @return array<string,array<string,array<int,string>>>|null
     */
    public function registerRoutes(): ?array;

    /**
     * Register the menus for the user menu
     *
     * @return array[]|null
     */
    public function registerUserMenu(): ?array;

    /**
     * Register the menus for the sidebar
     *
     * @return array[]|null
     */
    public function registerSidebar(): ?array;

    /**
     * Register the menus for the topbar
     *
     * @return array[]|null
     */
    public function registerTopbar(): ?array;

    /**
     * Register items for the dashboard
     *
     * @return array[]|null
     */
    public function registerDashboard(): ?array;

    /**
     * Says what php extensions the module requires
     *
     * @return string[]|null
     */
    public function requiresPhpExtensions(): ?array;

}
