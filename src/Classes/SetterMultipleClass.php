<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class SetterMultipleClass extends PlainClass {
    /**
     * @param string|null $info
     * @param string|null $first
     * @param int|null    $second
     *
     * @return void
     */
    public function set(
        ?string $info = null,
        ?string $first = null,
        ?int    $second = null
    ): void {
        $this->info = $info;
        $this->first = $first;
        $this->second = $second;
    }
}
