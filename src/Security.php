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
 *  This class manages the app Security
 */
class Security
{

    /**
     * Decrypt AES-256 encrypted data
     * @source https://www.php.net/manual/fr/class.sessionhandler.php
     */
    public static function decrypt(string $encryptedData, string $password): ?string
    {
        $data = base64_decode($encryptedData);
        $salt = substr($data, 0, 16);
        $ct   = substr($data, 16);

        $rounds  = 3; // depends on key length
        $data00  = $password . $salt;
        $hash    = array();
        $hash[0] = hash('sha256', $data00, true);
        $result  = $hash[0];
        for ($i = 1; $i < $rounds; $i++) {
            $hash[$i] = hash('sha256', $hash[$i - 1] . $data00, true);
            $result  .= $hash[$i];
        }
        $key = substr($result, 0, 32);
        $iv  = substr($result, 32, 16);

        $dec = openssl_decrypt($ct, 'AES-256-CBC', $key, 0, $iv);
        if ($dec === false) {
            return null;
        }
        return $dec;
    }

    /**
     * Encrypt data using AES-256
     * @source https://www.php.net/manual/fr/class.sessionhandler.php
     */
    public static function encrypt(string $data, string $password): string
    {
        // Set a random salt
        $salt = openssl_random_pseudo_bytes(16);

        $salted = '';
        $dx     = '';
        // Salt the key(32) and iv(16) = 48
        while (strlen($salted) < 48) {// phpcs:ignore Squiz.PHP.DisallowSizeFunctionsInLoops.Found
            $dx      = hash('sha256', $dx . $password . $salt, true);
            $salted .= $dx;
        }

        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32, 16);

        $encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        return base64_encode($salt . $encrypted_data);
    }

}
