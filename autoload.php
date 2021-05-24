<?php

/**
 * @source https://www.php-fig.org/psr/psr-4/examples/
 */

declare(strict_types = 1);

spl_autoload_register(
    static function ($class) {
        $namespaces = [
            [
                'prefix' => 'WdesAdmin\\', // project-specific namespace prefix
                'baseDir' => __DIR__ . '/src/', // base directory for the namespace prefix
            ],
            [
                'prefix' => 'WdesAdminModule\\', // project-specific namespace prefix
                'baseDir' => __DIR__ . '/modules/', // base directory for the namespace prefix
            ]
        ];

        foreach ($namespaces as $namespace) {
            // does the class use the namespace prefix?
            $len = strlen($namespace['prefix']);
            if (strncmp($namespace['prefix'], $class, $len) !== 0) {
                // no, move to the next registered autoloader
                continue;
            }

            // get the relative class name
            $relative_class = substr($class, $len);

            // replace the namespace prefix with the base directory, replace namespace
            // separators with directory separators in the relative class name, append
            // with .php
            $file = $namespace['baseDir'] . str_replace('\\', '/', $relative_class) . '.php';

            // if the file exists, require it
            if (file_exists($file)) {
                include $file;
                break; // Do not process other namespaces
            }
        }
    }
);
