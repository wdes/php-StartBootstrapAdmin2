<?php

declare(strict_types = 1);

namespace WdesAdmin;

use Exception;
use SessionHandler;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class DbSessionHandler extends SessionHandler
{
    /** @var string */
    private $key;

    /** @var string */
    private $sessionName;

    /** @var bool */
    private $isNew = false;

    /** @var Logger */
    private $logger;

    public function __construct(Logger $logger, string $key)
    {
        $this->key    = $key;
        $this->logger = $logger;
    }

    public function open($savePath, $sessionName)
    {
        $this->sessionName = $sessionName;

        // will throw if not connected
        Database::getInstance()->getConnection();
        return true;
    }

    public function create_sid()
    {
        $this->isNew = true;
        return parent::create_sid();
    }

    public function read($sessionId)
    {
        try {
            $stmt        = Database::getInstance()->query(
                'SELECT session_data FROM `sessions` WHERE session_id = ? AND session_name = ?',
                [
                    $sessionId,
                    $this->sessionName,
                ]
            );
            $sessionData = $stmt->fetchColumn();

            return $sessionData ? Security::decrypt($sessionData, $this->key) : '';
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to read session %s: %s',
                    $sessionId,
                    $e->getMessage()
                )
            );
            return '';
        }
    }

    public function write($sessionId, $sessionData)
    {
        try {
            $stmt = Database::getInstance()->query(
                'INSERT INTO `sessions`(`session_id`, `session_name`, `created_at`, `updated_at`, `session_data`)'
                . ' VALUES(?, ?, NOW(), NULL, ?) ON DUPLICATE KEY'
                . ' UPDATE updated_at = NOW(), session_data = ?',
                [
                    $sessionId,
                    $this->sessionName,
                    Security::encrypt($sessionData, $this->key),
                    Security::encrypt($sessionData, $this->key),
                ]
            );
            return $stmt->execute();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to write session %s: %s',
                    $sessionId,
                    $e->getMessage()
                )
            );
            return false;
        }
    }

    public function destroy($sessionId)
    {
        try {
            $stmt = Database::getInstance()->query(
                'DELETE FROM `sessions` WHERE session_id = ? AND session_name = ?',
                [
                    $sessionId,
                    $this->sessionName,
                ]
            );
            return $stmt->execute();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to destroy session %s: %s',
                    $sessionId,
                    $e->getMessage()
                )
            );
            return false;
        }
    }

    public function gc($maxlifetime)
    {
        try {
            $stmt = Database::getInstance()->query(
                'DELETE FROM `sessions` WHERE `created_at` < (NOW() - ?)',
                [
                    $maxlifetime
                ]
            );
            return $stmt->execute();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to gc sessions for %d: %s',
                    $maxlifetime,
                    $e->getMessage()
                )
            );
            return false;
        }
    }

    public function close()
    {
        return true;
    }

}
