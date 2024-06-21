<?php

declare(strict_types=1);

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
