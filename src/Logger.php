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

/**
 * It implements the PSR-3 logger interface
 * @source https://www.php-fig.org/psr/psr-3/
 */
class Logger
{
    /** @var resource|null */
    private static $logFileHandle = null;

    /** @var string */
    private $logFile;

    public function __construct(string $logFile)
    {
       $this->logFile = $logFile;
    }

    private function output(string $contents, bool $toStdErr): void
    {
        if (PHP_SAPI === 'cli') {// CLI mode
            if ($toStdErr) {
                fwrite(STDERR, $contents);
                return;
            }
            echo $contents;
            return;
        }

        if (self::$logFileHandle === null) {
            self::$logFileHandle = fopen($this->logFile, 'a');
        }
        if (self::$logFileHandle === false) {
            echo 'Could not open log file !';
            return;
        }
        fwrite(self::$logFileHandle, $contents);
    }

    /**
     * System is unusable.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->output('[EMERGENCY] ' . $message . PHP_EOL, true);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->output('[ALERT] ' . $message . PHP_EOL, true);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->output('[CRITICAL] ' . $message . PHP_EOL, true);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->output('[ERROR] ' . $message . PHP_EOL, true);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->output('[WARNING] ' . $message . PHP_EOL, false);
    }

    /**
     * Normal but significant events.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->output('[NOTICE] ' . $message . PHP_EOL, false);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->output('[INFO] ' . $message . PHP_EOL, false);
    }

    /**
     * Detailed debug information.
     *
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->output('[DEBUG] ' . $message . PHP_EOL, false);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param  mixed  $level
     * @param  string $message
     * @param  array  $context
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->output('[' . $level . '] ' . $message . PHP_EOL, false);
    }

}
