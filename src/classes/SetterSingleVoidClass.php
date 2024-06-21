<?php

declare(strict_types=1);

class SetterSingleVoidClass extends PlainClass {
    public function setInfo(?string $info = null): void
    {
        $this->info = $info;
    }

    public function setFirst(?string $first = null): void
    {
        $this->first = $first;
    }

    public function setSecond(?int $second = null): void
    {
        $this->second = $second;
    }
}
