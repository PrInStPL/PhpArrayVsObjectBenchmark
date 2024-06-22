<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/traits/SingleGettersTrait.php');

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
