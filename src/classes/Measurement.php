<?php

declare(strict_types=1);

class Measurement
{
    protected float $timeStart = 0.0;
    protected float $timeStop = 0.0;
    protected int $memoryStart = 0;
    protected int $memoryStop = 0;



    public function start(): self
    {
        $this->timeStart = microtime(true);
        $this->memoryStart = memory_get_usage();

        return $this;
    }
    
    public function stop(): self
    {
        $this->memoryStop = memory_get_usage();
        $this->timeStop = microtime(true);

        return $this;
    }
    
    public function getMemoryUsed(): int
    {
         return $this->memoryStop - $this->memoryStart;

    }
    
    public function getTimeTaken(): float
    {
        return $this->timeStop - $this->timeStart;
    }
}
