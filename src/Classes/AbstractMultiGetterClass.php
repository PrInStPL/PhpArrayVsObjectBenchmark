<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

abstract class AbstractMultiGetterClass extends AbstractSingleGetterClass {
    /**
     * @return non-empty-list<int|string|null>
     */
    public function getAll(): array
    {
        return [
            $this->getInfo(),
            $this->getFirst(),
            $this->getSecond(),
        ];
    }
}
