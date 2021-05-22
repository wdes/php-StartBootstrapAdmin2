<?php

use WdesAdmin\Session;
use WdesAdmin\WdesAdmin;

// Load the class auto-loader
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

// If you use require_once and it was already required it will return true and not the config
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

if (! is_array($config)) {
    echo 'Config file is missing or invalid !';
    exit(1);
}

WdesAdmin::init($config);
