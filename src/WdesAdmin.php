<?php

declare(strict_types = 1);

namespace WdesAdmin;

use PDOException;

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
    /** @var string */
    private static $secretKey;

    /** @var string */
    private static $siteName;

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
        self::$siteName = $config['siteName'];
        unset($config['siteName']);// Everyone must use the getter

        self::$secretKey = $config['secretKey'];
        unset($config['secretKey']);// Nobody must access this
        $logger = new Logger($config['logFile']);
        $db     = new Database($config);
        try {
            $db->connect();
        } catch (PDOException $e) {
            echo 'Database connection error, see logs';
            $logger->critical($e->getMessage());
            exit(1);
        }
        Session::init(
            $logger,
            self::$secretKey,
            $config['sessionName']
        );

        Session::setStorage($_SESSION);
    }

    public static function deinit(): void
    {
        Session::close();// Session depends on db
        Database::getInstance()->disconnect();
    }

    public static function cryptPassword(string $rawPassword): string
    {
        $securePassword   = hash('sha256', $rawPassword);
        $securityPassword = hash('sha512', $rawPassword);
        // Encrypt the password using the hash of the password + the secret key as a key
        // That should be hard enough to reverse in case of brute force attacks
        return Security::encrypt($securePassword, $securityPassword . self::$secretKey);
    }

    public static function passwordMatch(string $cryptedPassword, string $rawPassword): bool
    {
        $supposedPasswordInSecure = hash('sha256', $rawPassword);
        $securityPassword         = hash('sha512', $rawPassword);

        $storedPass = Security::decrypt($cryptedPassword, $securityPassword . self::$secretKey);

        if ($storedPass === null) {
            return false;
        }
        return hash_equals($storedPass, $supposedPasswordInSecure);
    }

    public static function getSiteName(): string
    {
        return self::$siteName;
    }

}
