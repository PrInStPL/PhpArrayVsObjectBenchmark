<?php

declare(strict_types=1);

readonly class ReadonlyConstructorClass
{
    use MultiGetterTrait;

    public function __construct(
        public ?string $info = null,
        public ?string $first = null,
        public ?int    $second = null
    ) {}

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getFirst(): ?string
    {
        return $this->first;
    }

    public function getSecond(): ?int
    {
        return $this->second;
    }

    public function getAll(): array
    {
        return [
            $this->getInfo(),
            $this->getFirst(),
            $this->getSecond(),
        ];
    }
}
