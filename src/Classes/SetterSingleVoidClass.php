<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class SetterSingleVoidClass extends PlainClass {
    /**
     * @param string|null $info
     *
     * @return void
     */
    public function setInfo(?string $info = null): void
    {
        $this->info = $info;
    }

    /**
     * @param string|null $first
     *
     * @return void
     */
    public function setFirst(?string $first = null): void
    {
        $this->first = $first;
    }

    /**
     * @param int|null $second
     *
     * @return void
     */
    public function setSecond(?int $second = null): void
    {
        $this->second = $second;
    }
}
