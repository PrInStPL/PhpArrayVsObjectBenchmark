<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/classes/AbstractSingleGetterClass.php');

abstract class AbstractMultiGetterClass extends AbstractSingleGetterClass {
    public function getAll(): array
    {
        return [
            $this->getInfo(),
            $this->getFirst(),
            $this->getSecond(),
        ];
    }
}
