<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/PlainClass.php');

class SetterSingleReturnClass extends PlainClass {
    public function setInfo(?string $info = null): self
    {
        $this->info = $info;

        return $this;
    }

    public function setFirst(?string $first = null): self
    {
        $this->first = $first;

        return $this;
    }

    public function setSecond(?int $second = null): self
    {
        $this->second = $second;

        return $this;
    }
}
