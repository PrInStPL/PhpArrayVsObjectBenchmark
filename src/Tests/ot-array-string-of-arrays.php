<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

use PhpArrayVsObjectBenchmark\Classes\Test;

(new Test('array (string key) of array'))
    ->createDataSet(
        function(array &$data, int $elementNr) {
            $valueInfo = Test::valueOfInfo('createDataSet', $elementNr);
            $data[$valueInfo] = [
                $valueInfo,
                Test::valueOfFirst($elementNr),
                $elementNr
            ];
        },
        function(): array {
            return [];
        }
    )
    ->testSetForeach(
        function(array &$dataSet, array $element, string $elementIndex, int $repetitionNr): void {
            $dataSet[$elementIndex][0] = Test::valueOfInfo('testSetForeach', $repetitionNr);
            $dataSet[$elementIndex][1] = Test::valueOfFirst($repetitionNr);
            $dataSet[$elementIndex][2] = $repetitionNr;
        },
    )
    ->testArrayMap(function(array $element): array {
        global $repetitionNr;
        $element[0] = Test::valueOfInfo('testArrayMap', $repetitionNr);
        $element[1] = Test::valueOfFirst($repetitionNr);
        $element[2] += $repetitionNr;
        return $element;
    })
    ->testArrayWalk(function(array &$element, string $elementIndex, int $repetitionNr): bool {
        $element[0] = Test::valueOfInfo('testArrayWalk', $repetitionNr);
        $element[1] = Test::valueOfFirst($repetitionNr);
        $element[2] = $repetitionNr;
        return true;
    })
    ->unsetDataSet()
    ->printTestResults()
;
