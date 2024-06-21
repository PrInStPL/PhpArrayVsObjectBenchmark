<?php

declare(strict_types=1);

abstract class AbstractMultiGetterClass extends AbstractSingleGetterClass {
    public function getAll(): array
    {
        return [
            $this->getInfo(),
            $this->getFirst(),
            $this->getSecond(),
        ];
    }
}
