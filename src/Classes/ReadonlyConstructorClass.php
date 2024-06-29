<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use PhpArrayVsObjectBenchmark\Traits\MultiGetterTrait;

if (80200 > PHP_VERSION_ID) {
    class ReadonlyConstructorClass{}
} else {
    readonly class ReadonlyConstructorClass
    {
        use MultiGetterTrait;

        /**
         * @param string|null $info
         * @param string|null $first
         * @param int|null    $second
         */
        public function __construct(
            public ?string $info = null,
            public ?string $first = null,
            public ?int    $second = null
        ) {}

        /**
         * @return string|null
         */
        public function getInfo(): ?string
        {
            return $this->info;
        }

        /**
         * @return string|null
         */
        public function getFirst(): ?string
        {
            return $this->first;
        }

        /**
         * @return int|null
         */
        public function getSecond(): ?int
        {
            return $this->second;
        }

        /**
         * @return array
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
}
