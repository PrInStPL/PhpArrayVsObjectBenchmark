<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/traits/MultiGetterTrait.php');
require_once(ABS_PATH . '/classes/AbstractMultiGetterClass.php');

class PlainClass extends AbstractMultiGetterClass {
    use MultiGetterTrait;

    public ?string $info = null;
    public ?string $first = null;
    public ?int $second = null;
}
