<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/PlainClass.php');

class ConstructorClass extends PlainClass {
    public function __construct(
        ?string $info = null,
        ?string $first = null,
        ?int    $second = null
    ) {
        $this->info = $info;
        $this->first = $first;
        $this->second = $second;
    }
}
