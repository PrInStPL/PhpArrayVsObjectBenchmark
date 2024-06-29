<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class SetterSingleNoReturnDefClass extends PlainClass {

    /**
     * @param string|null $info
     *
     * @return void
     */
    public function setInfo(?string $info = null)
    {
        $this->info = $info;
    }

    /**
     * @param string|null $first
     *
     * @return void
     */
    public function setFirst(?string $first = null)
    {
        $this->first = $first;
    }

    /**
     * @param int|null $second
     *
     * @return void
     */
    public function setSecond(?int $second = null)
    {
        $this->second = $second;
    }
}
