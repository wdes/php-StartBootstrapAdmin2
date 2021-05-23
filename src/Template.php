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

class Template
{

    /**
     * @var string template name in templates/ without .php at the end
     */
    public static function render(string $template, array $data = []): string
    {
        $template = __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.php';

        if (!is_file($template)) {
            throw new \RuntimeException('Template not found: ' . $template);
        }

        // define a closure with a scope for the variable extraction
        $result = function (string $file, array $data = []): string {
            ob_start();
            try {
                include $file;
            } catch (\Exception $e) {
                ob_end_clean();
                throw $e;
            }
            return (string) ob_get_clean();
        };

        // call the closure
        return $result->call(new TemplateContext($data), $template, $data);
    }

}
