<?php

declare(strict_types = 1);

namespace WdesAdmin;

use PDOException;
use SessionHandler;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

/**
 * The main class
 */
class WdesAdmin
{
    public static function checkExtensions(): void
    {
        if (! extension_loaded('openssl')) {
            echo 'Missing openssl extension !';
            exit(1);
        }
        if (! extension_loaded('curl')) {
            echo 'Missing curl extension !';
            exit(1);
        }
        if (! extension_loaded('session')) {
            echo 'Missing session extension !';
            exit(1);
        }
        if (! extension_loaded('hash')) {
            echo 'Missing hash extension !';
            exit(1);
        }
    }

    public static function init(array $config): void
    {
        self::checkExtensions();
        $logger = new Logger($config['logFile']);
        $db = new Database($config);
        try {
            $db->connect();
        } catch (PDOException $e) {
            echo 'Database connection error, see logs';
            $logger->critical($e->getMessage());
            exit(1);
        }
        Session::init(
            $logger,
            $config['secretKey'],
            $config['sessionName']
        );

        Session::setStorage($_SESSION);
    }

    public static function deinit(): void
    {
        Session::close();// Session depends on db
        Database::getInstance()->disconnect();
    }
}
