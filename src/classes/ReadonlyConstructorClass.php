<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/traits/MultiGetterTrait.php');

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
