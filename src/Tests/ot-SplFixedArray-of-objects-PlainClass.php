<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use PhpArrayVsObjectBenchmark\Classes\PlainClass;
use PhpArrayVsObjectBenchmark\Classes\Test;
use PhpArrayVsObjectBenchmark\Classes\TestConfig;
use SplFixedArray;

// # # # # # # # # # # # # # # # # # # # #
$classInit = new SplFixedArray();
unset($classInit);
$classInit = new PlainClass();
unset($classInit);
// # # # # # # # # # # # # # # # # # # # #

(new Test('SplFixedArray (sequence) of PlainClass'))
    ->createDataSet(
        function(SplFixedArray $data, int $elementNr) {
            $element = new PlainClass();
            $element->info = Test::valueOfInfo('createDataSet', $elementNr);
            $element->first = Test::valueOfFirst($elementNr);
            $element->second = $elementNr;
            $data[$elementNr] = $element;
        },
        function(): SplFixedArray {
            return new SplFixedArray(TestConfig::getDataSetCount());
        }
    )
    ->testSetForeach(
        function(SplFixedArray $dataSet, PlainClass $element, int $elementIndex, int $repetitionNr): void {
            $dataSet[$elementIndex]->info = Test::valueOfInfo('testSetForeach', $repetitionNr);
            $dataSet[$elementIndex]->first = Test::valueOfFirst($repetitionNr);
            $dataSet[$elementIndex]->second = $repetitionNr;
        },
    )
    ->testArrayMap(
        function(PlainClass $element): PlainClass {
            global $repetitionNr;
            $element->info = Test::valueOfInfo('testArrayMap', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second += $repetitionNr;
            return $element;
        },
        function(SplFixedArray $data): array {
            return $data->toArray();
        },
        function(array $mappedData): SplFixedArray {
            return SplFixedArray::fromArray($mappedData);
        }
    )
    ->testArrayWalk(
        function(PlainClass $element, int $elementIndex, int $repetitionNr): bool {
            $element->info = Test::valueOfInfo('testArrayWalk', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second = $repetitionNr;
            return true;
        },
        function(SplFixedArray $data): array {
            return $data->toArray();
        }
    )
    ->unsetDataSet()
    ->printTestResults()
;
