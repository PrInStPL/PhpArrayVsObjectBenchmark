<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/classes/PlainClass.php');

class SetterSingleNoReturnDefClass extends PlainClass {

    public function setInfo(?string $info = null)
    {
        $this->info = $info;
    }

    public function setFirst(?string $first = null)
    {
        $this->first = $first;
    }

    public function setSecond(?int $second = null)
    {
        $this->second = $second;
    }
}
