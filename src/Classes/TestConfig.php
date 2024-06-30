<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

abstract class TestConfig
{
    public const DATASET_COUNT_FAST = 2500;
    public const DATASET_COUNT_FULL = 50000;
    public const REPETITIONS_COUNT_FAST = 500;
    public const REPETITIONS_COUNT_FULL = 1000;


    /**
     * @var int
     */
    protected static int $elementCount = self::DATASET_COUNT_FULL;
    /**
     * @var int
     */
    protected static int $repetitionsCount = self::REPETITIONS_COUNT_FULL;
    /**
     * @var bool
     */
    protected static bool $testsExecutionDebugPrinting = false;
    /**
     * @var bool
     */
    protected static bool $testsExecutionInfoPrinting = true;



    /**
     * @return void
     */
    public static function setTestFast(): void
    {
        self::$elementCount = self::DATASET_COUNT_FAST;
        self::$repetitionsCount = self::REPETITIONS_COUNT_FAST;
    }

    /**
     * @return void
     */
    public static function setTestFull(): void
    {
        self::$elementCount = self::DATASET_COUNT_FULL;
        self::$repetitionsCount = self::REPETITIONS_COUNT_FULL;
    }

    /**
     * @return int
     */
    public static function getDataSetCount(): int
    {
        return self::$elementCount;
    }

    /**
     * @return int
     */
    public static function getRepetitions(): int
    {
        return self::$repetitionsCount;
    }

    /**
     * @return bool
     */
    public static function getTestsExecutionDebugPrinting(): bool
    {
        return self::$testsExecutionDebugPrinting;
    }

    /**
     * @param bool $visible
     *
     * @return void
     */
    public static function setTestsExecutionDebugPrinting(bool $visible = false): void
    {
        self::$testsExecutionDebugPrinting = $visible;
    }

    /**
     * @return bool
     */
    public static function getTestsExecutionInfoPrinting(): bool
    {
        return self::$testsExecutionInfoPrinting;
    }

    /**
     * @param bool $enabled
     *
     * @return void
     */
    public static function setTestsExecutionInfoPrinting(bool $enabled = true): void
    {
        self::$testsExecutionInfoPrinting = $enabled;
    }
}
