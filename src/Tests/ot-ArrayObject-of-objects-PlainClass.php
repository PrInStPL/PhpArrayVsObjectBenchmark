<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use ArrayObject;
use PhpArrayVsObjectBenchmark\Classes\PlainClass;
use PhpArrayVsObjectBenchmark\Classes\Test;

// # # # # # # # # # # # # # # # # # # # #
$classInit = new PlainClass();
unset($classInit);
// # # # # # # # # # # # # # # # # # # # #

(new Test('ArrayObject (sequence) of PlainClass'))
    ->createDataSet(
        function(ArrayObject $data, int $elementNr) {
            $element = new PlainClass();
            $element->info = Test::valueOfInfo('createDataSet', $elementNr);
            $element->first = Test::valueOfFirst($elementNr);
            $element->second = $elementNr;
            $data[] = $element;
        },
        function(): ArrayObject {
            return new ArrayObject();
        }
    )
    ->testSetForeach(
        function(ArrayObject $dataSet, PlainClass $element, int $elementIndex, int $repetitionNr): void {
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
        function(ArrayObject $data): array {
            return $data->getArrayCopy();
        },
        function(array $mappedData): ArrayObject {
            return new ArrayObject($mappedData);
        }
    )
    ->testArrayWalk(
        function(PlainClass $element, int $elementIndex, int $repetitionNr): bool {
            $element->info = Test::valueOfInfo('testArrayWalk', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second = $repetitionNr;
            return true;
        },
        function(ArrayObject $data): array {
            return $data->getArrayCopy();
        }
    )
    ->unsetDataSet()
    ->printTestResults()
;
