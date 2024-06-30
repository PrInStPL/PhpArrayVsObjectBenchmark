<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use PhpArrayVsObjectBenchmark\Classes\ChainPlainClass802;
use PhpArrayVsObjectBenchmark\Classes\Test;
use function array_pop;

// # # # # # # # # # # # # # # # # # # # #
$classInit = new ChainPlainClass802();
unset($classInit);
// # # # # # # # # # # # # # # # # # # # #

(new Test('ChainPlainClass802'))
    ->createDataSet(
        function(?ChainPlainClass802 &$dataSet, int $elementNr): void {
            $dataSet = new ChainPlainClass802(
                Test::valueOfInfo('createDataSet', $elementNr),
                Test::valueOfFirst($elementNr),
                $elementNr,
                $dataSet
            );
        },
        function(): null {
            return null;
        }
    )
    ->testSetForeach(
        function(
            ChainPlainClass802 $dataSet,
            ChainPlainClass802 $element,
            int $elementIndex,
            int $repetitionNr
        ): void {
            $dataSet->getIterator()->current()->info = Test::valueOfInfo('testSetForeach', $repetitionNr);
            $dataSet->getIterator()->current()->first = Test::valueOfFirst($repetitionNr);
            $dataSet->getIterator()->current()->second = $repetitionNr;
        },
    )
    ->testArrayMap(
        function(ChainPlainClass802 $element): ChainPlainClass802 {
            global $repetitionNr;
            $element->info = Test::valueOfInfo('testArrayMap', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second += $repetitionNr;
            return $element;
        },
        function(ChainPlainClass802 $dataSet): array {
            return $dataSet->getIterator()->toArray();
        },
        function(array $mappedData): ChainPlainClass802 {
            return array_pop($mappedData);
        }
    )
    ->testArrayWalk(
        function(ChainPlainClass802 $element, int $elementIndex, int $repetitionNr): bool {
            $element->info = Test::valueOfInfo('testArrayWalk', $repetitionNr);
            $element->first = Test::valueOfFirst($repetitionNr);
            $element->second = $repetitionNr;
            return true;
        },
        function(ChainPlainClass802 $dataSet): array {
            return $dataSet->getIterator()->toArray();
        }
    )
    ->unsetDataSet()
    ->printTestResults()
;
