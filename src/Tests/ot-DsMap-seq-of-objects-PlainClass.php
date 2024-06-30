<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use Ds\Map;
use PhpArrayVsObjectBenchmark\Classes\PlainClass;
use PhpArrayVsObjectBenchmark\Classes\Test;

// # # # # # # # # # # # # # # # # # # # #
$classInit = new Map();
unset($classInit);
$classInit = new PlainClass();
unset($classInit);
// # # # # # # # # # # # # # # # # # # # #

(new Test('\Ds\Map (sequence) of PlainClass'))
    ->createDataSet(
        function(Map $data, int $elementNr) {
            $element = new PlainClass();
            $element->info = Test::valueOfInfo('createDataSet', $elementNr);
            $element->first = Test::valueOfFirst($elementNr);
            $element->second = $elementNr;
            $data->put($elementNr, $element);
        },
        function(): Map {
            return new Map();
        }
    )
    ->testSetForeach(
        function(Map $dataSet, PlainClass $element, int $elementIndex, int $repetitionNr): void {
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
        function(Map $data): array {
            return $data->toArray();
        },
        function(array $mappedData): Map {
            return new Map($mappedData);
        }
    )
    ->testArrayWalk(
        function(PlainClass $element, int $elementIndex, int $repetitionNr): bool {
            $element->info = Test::valueOfInfo('testArrayWalk', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second = $repetitionNr;
            return true;
        },
        function(Map $data): array {
            return $data->toArray();
        }
    )
    ->unsetDataSet()
    ->printTestResults()
;
