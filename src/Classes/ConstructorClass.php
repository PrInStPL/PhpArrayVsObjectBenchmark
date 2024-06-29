<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class ConstructorClass extends PlainClass {
    /**
     * @param string|null $info
     * @param string|null $first
     * @param int|null    $second
     */
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
