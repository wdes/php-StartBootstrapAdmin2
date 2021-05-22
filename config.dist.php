<?php

declare(strict_types = 1);

return [
    'logFile' => __DIR__ . DIRECTORY_SEPARATOR . 'log.txt',
    'secretKey' => 'R*KhN9Z#kpzziVZXp^aiM3C9q86mEpYj3GsH8jr@HdViDxzM76DEq',// Fill this value with a long random string
    'sessionName' => 'admin-1',// Keep it simple, this allows easy multi sites on the same host
    'database' => [
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'production_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'development_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'currentDatabaseEnv' => 'production',
];