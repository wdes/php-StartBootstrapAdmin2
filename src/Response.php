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
 * Manages the response
 */
class Response
{
    /** @var string */
    private $contents = '';

    /** @var array<int,array<string,string>> */
    private $headers = [];

    public function send(): void
    {
        foreach ($this->headers as $header) {
            [$headerName, $headerValue] = $header;
            header($headerName . ': ' . $headerValue);
        }
        echo $this->contents;
    }

    public function addContents(string $contents): void
    {
        $this->contents .= $contents;
    }

    public function addHeader(string $name, string $contents): void
    {
        $this->headers[] = [$name, $contents];
    }
}
