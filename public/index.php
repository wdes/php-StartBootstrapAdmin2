<?php

declare(strict_types = 1);

use WdesAdmin\Routing;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'head.php';

Routing::manage($_GET['route'] ?? $_POST['route'] ?? '/');

require_once __DIR__ . DIRECTORY_SEPARATOR . 'foot.php';
