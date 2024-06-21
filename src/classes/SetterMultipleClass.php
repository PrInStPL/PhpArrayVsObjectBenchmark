<?php

declare(strict_types=1);

class SetterMultipleClass extends PlainClass {
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
