<?php

declare(strict_types=1);

class SetterSingleNoReturnDefClass extends PlainClass {

    public function setInfo(?string $info = null)
    {
        $this->info = $info;
    }

    public function setFirst(?string $first = null)
    {
        $this->first = $first;
    }

    public function setSecond(?int $second = null)
    {
        $this->second = $second;
    }
}
