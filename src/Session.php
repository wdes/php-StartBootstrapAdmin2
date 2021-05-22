<?php

declare(strict_types=1);

namespace WdesAdmin;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

/**
 *  This class manages the app Session
 */
class Session
{
    /** @var array<string,mixed> */
    protected static $storage;

    public static function init(Logger $logger, string $secretKey, string $sessionName): void
    {
        $handler = new DbSessionHandler($logger, $secretKey);
        session_set_save_handler($handler, true);
        session_name($sessionName);
        session_start();
    }

    public static function setStorage(array &$storage): void
    {
        self::$storage = &$storage;
    }

    /**
     * Set a session key
     * @param mixed $value
     */
    public static function set(string $key, $value): void
    {
        self::$storage[$key] = $value;
    }

    public static function destroy(): void
    {
        // Clean the data just in case
        foreach (self::$storage as $key => &$val) {
            unset(self::$storage[$key], $val);
        }
        session_destroy();
    }

    public static function close(): void
    {
        session_write_close();
    }
}
