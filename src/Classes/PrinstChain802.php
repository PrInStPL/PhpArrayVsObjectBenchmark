<?php /** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use IteratorAggregate;

abstract class PrinstChain802 implements IteratorAggregate
{
    private ?PrinstChain802Iterator $iterator = null;
    protected ?self $next = null;


    /**
     * @param static|null $previous
     */
    public function __construct(protected ?self $previous = null)
    {
        $this->previous?->setNext($this);
        $this->iterator?->append($this);
    }

    public function __destruct()
    {
        $this->previous?->setNext($this->next);
        $this->next?->setPrevious($this->previous);

        if ($current = ($this->previous ?? $this->next)) {
            $this->iterator?->recreate($current);
        }
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): PrinstChain802Iterator
    {
        if (!$this->iterator) {
            while ($element = ($element ?? $this)->getPrevious()) {
                $this->iterator = $element->iterator;

                if ($this->iterator) {
                    return $this->iterator;
                }
            }

            while ($element = ($element ?? $this)->getNext()) {
                $this->iterator = $element->iterator;

                if ($this->iterator) {
                    return $this->iterator;
                }
            }

            $this->iterator = new PrinstChain802Iterator($this);
        }

        return $this->iterator;
    }

    public function getNext(): ?static
    {
        return $this->next;
    }

    public function setNext(?self $next, bool $chainThisToNextPrevious = true): ?static
    {
        $this->next = $next;

        if ($chainThisToNextPrevious && $this !== $next?->getPrevious()) {
            $this->next?->setPrevious($this);
        }

        // ToDo: chain old next to him second previous if exists

        return $this;
    }

    public function getPrevious(): ?static
    {
        return $this->previous;
    }

    public function setPrevious(?self $previous, bool $chainThisToPreviousNext = true): ?static
    {
        $this->previous = $previous;

        if ($chainThisToPreviousNext && $this !== $previous?->getNext()) {
            $this->previous?->setNext($this);
        }

        // ToDo: chain old previous to him second next if exists

        return $this;
    }
}
