<?php

declare(strict_types = 1);

namespace WdesAdmin;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class Flash
{

    public const LEVEL_SUCCESS = 'success';
    public const LEVEL_DANGER  = 'danger';
    public const LEVEL_WARNING = 'warning';
    public const LEVEL_INFO    = 'info';

    private const SESSION_KEY = 'flash_messages';

    public static function clear(): void
    {
        Session::set(self::SESSION_KEY, []);
    }

    public static function getMessages(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * @phpstan-param self::LEVEL_* $level
     */
    public static function addMessage(string $level, string $message): void
    {
        Session::push(
            self::SESSION_KEY,
            [
            'level' => $level,
            'message' => $message
            ]
        );
    }

}
