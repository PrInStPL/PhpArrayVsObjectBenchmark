<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

abstract class AbstractSingleGetterClass {
    /**
     * @return string|null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @return string|null
     */
    public function getFirst(): ?string
    {
        return $this->first;
    }

    /**
     * @return int|null
     */
    public function getSecond(): ?int
    {
        return $this->second;
    }
}
