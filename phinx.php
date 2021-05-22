<?php

declare(strict_types = 1);

$config = require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => $config['currentDatabaseEnv'],
    ] + $config['database'],
    'version_order' => 'creation'
];
