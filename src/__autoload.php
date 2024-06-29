<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark;

use function define;
use function defined;

defined('ABS_PATH') || define('ABS_PATH', __DIR__);

spl_autoload_register(function(string $class) {
    $class = str_replace(
        [
            '\\',
            'PhpArrayVsObjectBenchmark/',
        ],
        [
            '/',
            '',
        ],
        $class
    );

    foreach (
        [
            '/',
            '/Classes/',
            '/Core/',
            '/Traits/',
        ] as $dir
    ) {
        if (file_exists($path = ABS_PATH . $dir . $class . '.php')) {
            require_once($path);
            break;
        }
    }
});
