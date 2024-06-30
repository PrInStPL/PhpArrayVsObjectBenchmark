<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use Iterator;
use function spl_object_id;

class PrinstChain802Iterator extends ArrayIterator implements Countable, Iterator
{
    protected int $count = 1;
    protected ?PrinstChain802 $current = null;
    protected PrinstChain802 $first;
    protected int $key = 0;
    protected PrinstChain802 $last;



    public function __construct(PrinstChain802 $current) {
        $this->recreate($current);
        parent::__construct($this->toArray());
    }

    /**
     * @inheritDoc
     */
    public function current(): ?PrinstChain802
    {
        return $this->current;
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->current = $this->current?->getNext();
        $this->key++;
    }

    /**
     * @inheritDoc
     */
    public function key(): ?int
    {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->current !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->current = $this->first;
        $this->key = 0;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $key): bool
    {
        if (is_int($key)) {
            if (0 < $key && $this->count < $key) {
                return true;
            }
        } elseif ($key instanceof PrinstChain802) {
            return false !== $this->findKey($key);
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $key): ?PrinstChain802
    {
        if (!is_int($key)) {
            throw new InvalidArgumentException('Offset must be an integer');
        }

        if (0 === $key) {
            return $this->first;
        } elseif ($this->key === $key) {
            return $this->current;
        } else {
            $element = $this->first;

            for ($i = 0; $i <= $key; ++$i) {
                $element = $element->getNext();
            }

            return $element;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        if (!is_int($key)) {
            throw new InvalidArgumentException('Offset must be an integer');
        }

        if (!($value instanceof PrinstChain802)) {
            throw new InvalidArgumentException('Value must be an instance of ' . PrinstChain802::class);
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $key): void
    {
        if (!is_int($key)) {
            throw new InvalidArgumentException('Offset must be an integer');
        }
        // TODO: Implement offsetUnset() method.
    }

    public function getFirst(): PrinstChain802
    {
        return $this->first;
    }

    public function getFirstKey(): int
    {
        return 0;
    }

    public function getLast(): PrinstChain802
    {
        return $this->last;
    }

    public function getLastKey(): int
    {
        return $this->key - 1;
    }

    public function append(mixed $value): void
    {
        if (!($value instanceof PrinstChain802)) {
            throw new InvalidArgumentException('Value must be an instance of ' . PrinstChain802::class);
        }

        if (false !== $this->findKey($value)) {
            throw new InvalidArgumentException('Element already exists in chain');
        }

        if ($this->last->getNext() !== $value) {
            $this->last->setNext($value);
        }

        if ($value->getPrevious() !== $this->last) {
            $value->setPrevious($value);
        }

        $this->count++;
        $this->key++;
        $this->last = $value;
    }

    /**
     * @param PrinstChain802 $any
     * @param bool           $asCurrentKet
     *
     * @return void
     */
    public function recreate(PrinstChain802 $any, bool $asCurrentKet = true): void
    {
        $this->count = 1;

        $this->first = $any;
        $element = $any;
        $key = 0;
        while ($element = $element->getPrevious()) {
            $this->count++;
            $this->first = $element;
            $key--;
        }

        if ($asCurrentKet) {
            $this->current = $any;
            $this->key = abs($key);
        } else {
            $this->current = $this->first;
            $this->key = 0;
        }

        $this->last = $any;
        $element = $any;
        while ($element = $element->getNext()) {
            $this->count++;
            $this->last = $element;
        }
    }

    /**
     * @param PrinstChain802 $element
     *
     * @return int|false
     */
    public function findKey(PrinstChain802 $element): int|false
    {
        $candidate = $this->first;
        $key = 0;

        if ($candidate === $element) {
            return $key;
        }

        while ($candidate = $candidate->getNext()) {
            $key++;
            if ($candidate === $element) {
                return $key;
            }
        }

        return false;
    }

    /**
     * @param int $key
     *
     * @return bool
     */
    public function setCurrentKey(int $key): bool
    {
        if (!$this->offsetExists($key)) {
            return false;
        }

        if (0 === $key) {
            $this->current = $this->first;
        } elseif (($this->count - 1) === $key) {
            $this->current = $this->last;
        } else {
            $current = $this->first;
            for ($i = 1; $i <= $key; ++$i) {
                $current = $current->getNext();
            }
            $this->current = $current;
        }

        $this->key = $key;

        return true;
    }

    /**
     * @return PrinstChain802[]
     */
    public function toArray(): array
    {
        $array = [$element = $this->first];

        while ($element = $element->getNext()) {
            $array[] = $element;
        }

        return $array;
    }

    /**
     * @return non-empty-array
     */
    public function __debugInfo(): array
    {
        return [
            'count' => $this->count,
            'first object id' => spl_object_id($this->first),
            'key' => $this->key,
            'current object id' => spl_object_id($this->current),
            'last object id' => spl_object_id($this->last),
        ];
    }
}
