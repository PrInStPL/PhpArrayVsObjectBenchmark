<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use PhpArrayVsObjectBenchmark\Traits\MultiGetterTrait;

class PlainClass extends AbstractMultiGetterClass {
    use MultiGetterTrait;

    public ?string $info = null;
    public ?string $first = null;
    public ?int $second = null;
}
