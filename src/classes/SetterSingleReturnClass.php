<?php

declare(strict_types=1);

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
