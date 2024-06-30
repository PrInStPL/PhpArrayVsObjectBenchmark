<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use function spl_object_id;

class ChainPlainClass802 extends PrinstChain802 {
    public function __construct(
        public ?string $info = null,
        public ?string $first = null,
        public ?int    $second = null,
        ?self          $previous = null
    ) {
        parent::__construct($previous);
    }

    public function __debugInfo(): array
    {
        return [
            'info' => $this->info,
            'first' => $this->first,
            'second' => $this->second,
            'object id' => spl_object_id($this),
            'previous object id' => $this->previous ? spl_object_id($this->previous) : null,
            'next object id' => $this->next ? spl_object_id($this->next) : null,
        ];
    }
}
