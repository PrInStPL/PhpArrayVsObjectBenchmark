<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

abstract class AbstractSingleGetterClass {
    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getFirst(): ?string
    {
        return $this->first;
    }

    public function getSecond(): ?int
    {
        return $this->second;
    }
}
