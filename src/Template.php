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
    public static function render(string $template, array $data = []): string
    {
        $S = DIRECTORY_SEPARATOR;
        $root = realpath(__DIR__ . $S . '..' . $S);

        // @[profile]/templateName
        // templateName
        $isTemplateModule = stripos($template, '@[') === 0;

        if ($isTemplateModule) {
            $templateModuleFile = $root . $S . 'modules' . $S . '%s' . $S . 'templates' . $S . '%s.php';

            $posEnd = strpos($template, ']/');
            $moduleName = substr($template, 2, $posEnd - 2);// start after @[ and stop before ]/
            $template = substr($template, $posEnd + 2);

            $file = sprintf(
                $templateModuleFile,
                $moduleName,
                $template
            );
            return self::renderFile($file, $data);
        }

        $templateFile = $root . $S . 'templates' . $S . '%s.php';
        $file = sprintf(
            $templateFile,
            $template
        );
        return self::renderFile($file, $data);
    }

    /**
     * @var string template file
     */
    public static function renderFile(string $template, array $data = []): string
    {
        if (! is_file($template)) {
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
