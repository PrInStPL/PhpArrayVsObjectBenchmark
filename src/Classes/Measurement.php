<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class Measurement
{
    protected int $memoryStart = 0;
    protected int $memoryStop = 0;
    protected float $timeStart = 0.0;
    protected float $timeStop = 0.0;

    protected static int $memoryGlobal = 0;
    protected static float $timeGlobal = 0.0;


    /**
     * @return $this
     */
    public function start(): self
    {
        $this->timeStart = microtime(true);
        $this->memoryStart = memory_get_usage();

        return $this;
    }

    /**
     * @return $this
     */
    public function stop(): self
    {
        $this->memoryStop = memory_get_usage();
        $this->timeStop = microtime(true);

        self::$memoryGlobal += $this->memoryStop - $this->memoryStart;
        self::$timeGlobal += $this->timeStop - $this->timeStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getMemoryUsed(): int
    {
         return $this->memoryStop - $this->memoryStart;

    }

    /**
     * @return float
     */
    public function getTimeTaken(): float
    {
        return $this->timeStop - $this->timeStart;
    }

    /**
     * @return int
     */
    public static function getMemoryUsedGlobal(): int
    {
         return self::$memoryGlobal;

    }

    /**
     * @return float
     */
    public static function getTimeTakenGlobal(): float
    {
        return self::$timeGlobal;
    }
}
