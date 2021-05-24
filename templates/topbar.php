<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="mdi mdi-menu"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php $this->value('user_display_name'); ?></span>
            <i class="mdi mdi-account-circle-outline"></i>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <?php
            foreach ($this->getUserMenus() as $menu) {
                if ($menu['divider'] ?? false) {
                    echo <<<HTML
                        <div class="dropdown-divider"></div>
HTML;
                    continue;
                }
                $route = $this->buildRoute($menu['route'] ?? '');
                $text = $this->safe($menu['text'] ?? '?');
                echo <<<HTML
                    <a class="dropdown-item" href="{$route}">
                        <i class="mdi mdi-account mr-2 text-gray-400"></i>
                        {$text}
                    </a>
HTML;
            }
            ?>
            <a class="dropdown-item" href="<?php $this->route('/logout'); ?>">
                <i class="mdi mdi-logout-variant mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>