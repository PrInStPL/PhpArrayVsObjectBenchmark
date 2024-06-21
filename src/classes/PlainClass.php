<?php

declare(strict_types=1);

class PlainClass extends AbstractMultiGetterClass {
    use MultiGetterTrait;

    public ?string $info = null;
    public ?string $first = null;
    public ?int $second = null;
}
