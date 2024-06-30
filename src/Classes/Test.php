<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

class Test
{
    /**
     * @var array|object|null $dataSet
     * @noinspection PhpMissingFieldTypeInspection 7.4 don't have union types
     */
    protected $dataSet = null;
    /** @var Measurement[] $measurements */
    protected array $measurements = [];

    /**
     * @var int
     */
    private int $debugEchoLength = 0;


    /**
     * @param string $name
     */
    public function __construct(string $name) {
        $this->executionSection($name);
    }

    /**
     * @param string $__function__
     *
     * @return Measurement
     */
    protected function measurementStart(string $__function__): Measurement
    {
        if (empty($this->measurements[$__function__])) {
            $this->measurements[$__function__] = new Measurement();
        }

        return $this->measurements[$__function__]->start();
    }

    /**
     * @param string $__function__
     *
     * @return Measurement
     */
    protected function measurementStop(string $__function__): Measurement
    {
        if (empty($this->measurements[$__function__])) {
            $this->measurementStart($__function__);
        }

        return $this->measurements[$__function__]->stop();
    }

    /**
     * @return void
     */
    public static function printResults(): void
    {
        echo PHP_EOL;
        echo '-> PHP ver.: ' . PHP_VERSION . PHP_EOL;
        echo '-> The number of elements: ' . TestConfig::getDataSetCount() . PHP_EOL;
        echo '-> The number of repetitions: ' . TestConfig::getRepetitions() . PHP_EOL;
        echo '-> Time taken (in seconds) by all tests: ' . Measurement::getTimeTakenGlobal() . PHP_EOL;
        echo '-> Memory used (in bytes) by all tests: '
            . number_format(Measurement::getMemoryUsedGlobal(), 0, '', ' ')
            . PHP_EOL
        ;

        echo PHP_EOL;
        /** @noinspection PhpRedundantOptionalArgumentInspection */
        StaticReport::printResult(StaticReport::PRINT_CLI, StaticReport::LAYOUT_SECTIONS_LEFT);
        echo PHP_EOL;
    }

    /**
     * @return void
     */
    protected function printTestExecutionDebugInfo(): void
    {
        if (TestConfig::getTestsExecutionDebugPrinting()) {
            echo '.';

            if (80 <= ++$this->debugEchoLength) {
                echo PHP_EOL;
                $this->debugEchoLength = 0;
            }
        }
    }

    /**
     * @return int
     */
    protected function getTestsMemoryCalculated(): int
    {
        $memory = 0;

        foreach ($this->measurements as $measurement) {
            $memory += $measurement->getMemoryUsed();
        }

        return $memory;
    }

    /**
     * @return float
     */
    protected function getTestsTimeCalculated(): float
    {
        $time = 0.0;

        foreach ($this->measurements as $measurement) {
            $time += $measurement->getTimeTaken();
        }

        return $time;
    }

    /**
     * @return $this
     */
    public function printTestResults(): self
    {
        $textTime = '* test object time used (seconds): ' . $this->getTestsTimeCalculated();
        $textMemory
            = '* test object memory used (seconds): '
            . number_format($this->getTestsMemoryCalculated(), 0, '', ' ')
        ;
        $coverLength
            = ($textTimeLength = strlen($textTime)) > ($textMemoryLength = strlen($textMemory))
            ? $textTimeLength
            : $textMemoryLength
        ;

        echo str_repeat('-', $coverLength) . PHP_EOL
            . $textTime . PHP_EOL
            . $textMemory . PHP_EOL
            . str_repeat('-', $coverLength) . PHP_EOL
        ;

        return $this;
    }

    /**
     * @param string $section
     *
     * @return void
     */
    protected function executionSection(string $section): void
    {
        if (TestConfig::getTestsExecutionInfoPrinting()) {
            $section = 'TEST: ' . $section;
            $sectionLength = strlen($section);
            $sectionCover = str_repeat('-', $sectionLength);

            echo PHP_EOL
                . $sectionCover . PHP_EOL
                . $section . PHP_EOL
                . $sectionCover . PHP_EOL
                . '* PHP ver.: ' . PHP_VERSION . PHP_EOL
                . '* data set length: ' . number_format(TestConfig::getDataSetCount(), 0, '', ' ') . PHP_EOL
                . '* get/set repetitions: ' . number_format(TestConfig::getRepetitions(), 0, '', ' ') . PHP_EOL
                . PHP_EOL
            ;

            $this->debugEchoLength = 0;
        }

        StaticReport::addSection($section);
    }

    /**
     * @param string      $header
     * @param int         $repetitions
     * @param string|null $__function__
     *
     * @return void
     */
    protected function executionHeader(string $header, int $repetitions, ?string $__function__ = null): void
    {
        if (TestConfig::getTestsExecutionInfoPrinting()) {
            echo "-> $header [repetitions: "
                . number_format($repetitions, 0, '', ' ')
                . ']'
                . PHP_EOL
            ;

            $this->debugEchoLength = 0;
        }

        StaticReport::addHeader($__function__ ?? $header);
        StaticReport::addResult(
            StaticReport::RESULT_TYPE_REPETITION,
            number_format($repetitions, 0, '', ' ')
        );
    }

    /**
     * @param Measurement $measurement
     *
     * @return void
     */
    protected function executionResult(Measurement $measurement): void
    {
        if (TestConfig::getTestsExecutionInfoPrinting()) {
            if (TestConfig::getTestsExecutionDebugPrinting()) {
                echo PHP_EOL;
            }

            echo '   time taken (seconds): ' . $measurement->getTimeTaken() . PHP_EOL
                . '   memory used (bytes): ' . number_format($measurement->getMemoryUsed(), 0, '', ' ') . PHP_EOL
                . PHP_EOL
            ;

            $this->debugEchoLength = 0;
        }

        StaticReport::addResult(
            StaticReport::RESULT_TYPE_TIME,
            (string) $measurement->getTimeTaken()
        );
        StaticReport::addResult(
            StaticReport::RESULT_TYPE_MEMORY,
            number_format($measurement->getMemoryUsed(), 0, '', ' ')
        );
    }

    /**
     * @param callable(array|object &$dataSet, non-negative-int $elementNr): void $dataSetCreation
     * @param callable(): array|object|null $dataSetInitialization
     *
     * @return self
     * @noinspection PhpDocSignatureInspection
     */
    public function createDataSet(callable $dataSetCreation, callable $dataSetInitialization): self
    {
        $this->executionHeader(__FUNCTION__, TestConfig::getDataSetCount());

        $this->measurementStart(__FUNCTION__);

        $this->dataSet = $dataSetInitialization();
        $this->printTestExecutionDebugInfo();

        for ($i = 0; $i < TestConfig::getDataSetCount(); $i++) {
            $dataSetCreation($this->dataSet, $i);

            $this->printTestExecutionDebugInfo();
        }

        $this->executionResult($this->measurementStop(__FUNCTION__));

        return $this;
    }

    /**
     * @param callable(array|object &$element, int $elementIndex, int $repetitionNr): bool $arrayWalkCallable Have to
     *                                         return true to walk successfully
     * @param null|callable(array|object &$dataSet, int $repetitionNr): array              $dataSetAlternative
     *
     * @return self
     */
    public function testArrayWalk(
        callable  $arrayWalkCallable,
        ?callable $dataSetAlternative = null
    ): self {
        $this->executionHeader(__FUNCTION__, TestConfig::getRepetitions());

        $this->measurementStart(__FUNCTION__);

        if (is_null($dataSetAlternative)) {
            for ($i = 0; $i < TestConfig::getRepetitions(); $i++) {
                array_walk(
                    $this->dataSet,
                    $arrayWalkCallable,
                    $i
                );

                $this->printTestExecutionDebugInfo();
            }
        } else {
            for ($i = 0; $i < TestConfig::getRepetitions(); $i++) {
                $dataSet = $dataSetAlternative($this->dataSet);

                array_walk(
                    $dataSet,
                    $arrayWalkCallable,
                    $i
                );

                $this->printTestExecutionDebugInfo();
            }
        }

        $this->executionResult($this->measurementStop(__FUNCTION__));

        return $this;
    }

    /**
     * @param callable(array|object $element): array|object                                      $arrayMapCallable
     * @param null|callable(array|object &$dataSet, int $repetitionNr): array                    $dataSetAlternative
     * @param null|callable(array &$mappedDataArray, array|object &$sourceDataSet): array|object $dataSetFinisher
     *
     * @return self
     * @noinspection PhpDocSignatureInspection
     */
    public function testArrayMap(
        callable  $arrayMapCallable,
        ?callable $dataSetAlternative = null,
        ?callable $dataSetFinisher = null
    ): self {
        global $repetitionNr;

        $this->executionHeader(__FUNCTION__, TestConfig::getRepetitions());

        $this->measurementStart(__FUNCTION__);

        for ($repetitionNr = 0; $repetitionNr < TestConfig::getRepetitions(); $repetitionNr++) {
            $dataSet = $dataSetAlternative
                ? $dataSetAlternative($this->dataSet, $repetitionNr)
                : null
            ;

            $mappedDataSet = array_map(
                $arrayMapCallable,
                $dataSet ?? $this->dataSet
            );

            if ($dataSetFinisher) {
                $this->dataSet = $dataSetFinisher($mappedDataSet, $this->dataSet);
            }
            $this->dataSet = $dataSetFinisher
                ? $dataSetFinisher($mappedDataSet, $this->dataSet)
                : $mappedDataSet
            ;

            $this->printTestExecutionDebugInfo();
        }

        $this->executionResult($this->measurementStop(__FUNCTION__));

        unset($repetitionNr);

        return $this;
    }

    /**
     * For unify values
     *
     * @param string $case
     * @param int    $i
     *
     * @return string
     */
    public static function valueOfInfo(string $case, int $i): string {
        return "Some $i information in $i $case repetition";
    }

    /**
     * For unify values
     *
     * @param int $i
     *
     * @return string
     */
    public static function valueOfFirst(int $i): string {
        return sprintf('%015d', $i);
    }

    /**
     * The premise is to set element values by it storage key.
     *
     * @param callable(array|object &$dataSet, array|object $element, int|string $elementIndex, int $repetitionNr): void $callable
     *
     * @return $this
     */
    public function testSetForeach(callable $callable): self
    {
        $this->executionHeader(__FUNCTION__, TestConfig::getRepetitions());

        $this->measurementStart(__FUNCTION__);

        for ($repetitionNr = 0; $repetitionNr < TestConfig::getRepetitions(); $repetitionNr++) {
            foreach ($this->dataSet as $key => $value) {
                $callable($this->dataSet, $value, $key, $repetitionNr);

                $this->printTestExecutionDebugInfo();
            }
        }

        $this->executionResult($this->measurementStop(__FUNCTION__));

        return $this;
    }

    /**
     * @param callable(array|object $element, int|string $elementIndex, int $repetitionNr): array|object    $setValuesCallable
     * @param null|callable(array|object &$element, int|string $elementIndex, array|object &$dataSet): void $dataSetFinisher
     *
     * @return $this
     * @noinspection PhpDocSignatureInspection
     */
    public function testSetFor(callable $setValuesCallable, ?callable $dataSetFinisher = null): self
    {
        $this->executionHeader(__FUNCTION__, TestConfig::getRepetitions());

        $this->measurementStart(__FUNCTION__);

        if (is_null($dataSetFinisher)) {
            for ($repetitionNr = 0; $repetitionNr < TestConfig::getRepetitions(); $repetitionNr++) {
                foreach ($this->dataSet as $key => $value) {
                    $setValuesCallable($value, $key, $repetitionNr);

                    $this->printTestExecutionDebugInfo();
                }
            }
        } else {
            for ($repetitionNr = 0; $repetitionNr < TestConfig::getRepetitions(); $repetitionNr++) {
                foreach ($this->dataSet as $elementIndex => $element) {
                    $dataSetFinisher(
                        $setValuesCallable($element, $elementIndex, $repetitionNr),
                        $elementIndex,
                        $this->dataSet
                    );

                    $this->printTestExecutionDebugInfo();
                }
            }
        }

        $this->executionResult($this->measurementStop(__FUNCTION__));

        return $this;
    }

    /**
     * @return $this
     */
    public function unsetDataSet(): self
    {
        $this->dataSet = null;

        return $this;
    }
}
