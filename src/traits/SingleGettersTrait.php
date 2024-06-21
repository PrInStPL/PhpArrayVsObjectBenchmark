<?php

declare(strict_types=1);

trait SingleGettersTrait {
    public function getInfoByTrait(): ?string
    {
        return $this->info;
    }

    public function getFirstByTrait(): ?string
    {
        return $this->first;
    }

    public function getSecondByTrait(): ?int
    {
        return $this->second;
    }
}
