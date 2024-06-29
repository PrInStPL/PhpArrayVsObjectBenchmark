<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class SetterSingleReturnClass extends PlainClass {
    /**
     * @param string|null $info
     *
     * @return $this
     */
    public function setInfo(?string $info = null): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @param string|null $first
     *
     * @return $this
     */
    public function setFirst(?string $first = null): self
    {
        $this->first = $first;

        return $this;
    }

    /**
     * @param int|null $second
     *
     * @return $this
     */
    public function setSecond(?int $second = null): self
    {
        $this->second = $second;

        return $this;
    }
}
