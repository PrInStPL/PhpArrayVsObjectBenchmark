<?php

declare(strict_types=1);

class ConstructorClass extends PlainClass {
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
