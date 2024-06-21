<?php

declare(strict_types=1);

trait MultiGetterTrait {
    use SingleGettersTrait;

    public function getAllByTrait(): array
    {
        return [
            $this->getInfoByTrait(),
            $this->getFirstByTrait(),
            $this->getSecondByTrait(),
        ];
    }
}
