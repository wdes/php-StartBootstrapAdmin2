<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php $this->route('/'); ?>">
        <div class="sidebar-brand-text mx-3"><?php $this->value('site_name'); ?></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php $this->route('/'); ?>">
            <i class="mdi mdi-view-dashboard"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">
    <?php
    foreach ($this->getSidebarMenus() as $menu) {
        if ($menu['divider'] ?? false) {
            echo <<<HTML
            <hr class="sidebar-divider">
HTML;
            continue;
        }
        if ($menu['heading'] ?? false) {
            $headingText = $this->safe($menu['heading'] ?? '?');
            echo <<<HTML
            <div class="sidebar-heading">{$headingText}</div>
HTML;
            continue;
        }
        if ($menu['collapse'] ?? false) {
            $text = $this->safe($menu['collapse']['text'] ?? '?');
            $icon = $this->safe($menu['collapse']['icon'] ?? '');
            $uniqueId = time() . random_int(0, 15000);
            $activeMode = false;
            foreach ($menu['collapse']['childs'] as $menuChild) {
                foreach ($menuChild['links'] as $link) {
                    if ($this->equalsCurrentRoute($link['route'])) {
                        $activeMode = true;
                        break 2;// stops this foreach and it's parent
                    }
                }
            }
            $classActive = $activeMode ? 'active' : '';
            $classCollapsed = $activeMode ? 'collapsed' : '';
            $expanded = $activeMode ? 'true' : 'false';
            echo <<<HTML
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {$classActive}">
                <a class="nav-link {$classCollapsed}" href="#" data-toggle="collapse" data-target="#collapse-{$uniqueId}" aria-expanded="{$expanded}" aria-controls="collapse-{$uniqueId}">
                    <i class="{$icon}"></i>
                    <span>{$text}</span>
                </a>
HTML;
        foreach ($menu['collapse']['childs'] as $menuChild) {
            $classShow = $activeMode ? 'show' : '';
            $menuChildHeaderText = $this->safe($menuChild['header-text'] ?? '');
            echo <<<HTML
                <div id="collapse-{$uniqueId}" class="collapse {$classShow}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">{$menuChildHeaderText}</h6>
HTML;
                    foreach ($menuChild['links'] as $link) {
                        $text = $this->safe($link['text'] ?? '?');
                        $route = $this->buildRoute($link['route'] ?? '');
                        $activeClass = $this->equalsCurrentRoute($link['route']) ? 'active' : '';
                        echo <<<HTML
                        <a class="collapse-item {$activeClass}" href="{$route}">{$text}</a>
HTML;
                    }
echo <<<HTML
                    </div>
                </div>
HTML;
        }
echo <<<HTML
        </li>
HTML;
        }
    }
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>