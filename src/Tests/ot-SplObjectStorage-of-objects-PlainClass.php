<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use PhpArrayVsObjectBenchmark\Classes\PlainClass;
use PhpArrayVsObjectBenchmark\Classes\Test;
use SplObjectStorage;

// # # # # # # # # # # # # # # # # # # # #
$classInit = new SplObjectStorage();
unset($classInit);
$classInit = new PlainClass();
unset($classInit);
// # # # # # # # # # # # # # # # # # # # #

(new Test('SplObjectStorage of PlainClass'))
    ->createDataSet(
        function(SplObjectStorage $data, int $elementNr) {
            $element = new PlainClass();
            $element->info = Test::valueOfInfo('createDataSet', $elementNr);
            $element->first = Test::valueOfFirst($elementNr);
            $element->second = $elementNr;
            $data->attach($element);
        },
        function(): SplObjectStorage {
            return new SplObjectStorage();
        }
    )
    ->testSetForeach(
        function(SplObjectStorage $dataSet, PlainClass $element, int $elementIndex, int $repetitionNr): void {
            $dataSet->current()->info = Test::valueOfInfo('testSetForeach', $repetitionNr);
            $dataSet->current()->first = Test::valueOfFirst($repetitionNr);
            $dataSet->current()->second = $repetitionNr;
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
        function(SplObjectStorage $dataSet): array {
            $dataSet->rewind();
            $data = [];
            while ($dataSet->valid()) {
                $data[] = $dataSet->current();
                $dataSet->next();
            }
            $dataSet->rewind();

            return $data;
        },
        function(array $mappedData): SplObjectStorage {
            $newDataSet = new SplObjectStorage();
            foreach ($mappedData as $element) {
                $newDataSet->attach($element);
            }

            return $newDataSet;
        }
    )
    ->testArrayWalk(
        function(PlainClass $element, int $elementIndex, int $repetitionNr): bool {
            $element->info = Test::valueOfInfo('testArrayWalk', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second = $repetitionNr;
            return true;
        },
        function(SplObjectStorage $dataSet): array {
            $dataSet->rewind();
            $data = [];
            while ($dataSet->valid()) {
                $data[] = $dataSet->current();
                $dataSet->next();
            }
            $dataSet->rewind();

            return $data;
        }
    )
    ->unsetDataSet()
    ->printTestResults()
;
