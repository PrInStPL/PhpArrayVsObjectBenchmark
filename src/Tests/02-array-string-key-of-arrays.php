<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

require_once(ABS_PATH . '/Core/constants.php');
require_once(ABS_PATH . '/Core/functions.php');

use PhpArrayVsObjectBenchmark\Classes\Measurement;
use function PhpArrayVsObjectBenchmark\Core\ {
    echoHeader,
    echoResults,
    echoSection,
    valueOfInfo,
    valueOfFirst,
};
use const PhpArrayVsObjectBenchmark\{
    ELEMENTS_COUNT,
    REPETITIONS_GET,
    REPETITIONS_SET,
    Core\CASE_CREATE,
    Core\CASE_GET,
    Core\CASE_GET_1,
    Core\CASE_GET_2,
    Core\CASE_GET_3,
    Core\CASE_GET_4,
    Core\CASE_GET_5,
    Core\CASE_GET_6,
    Core\CASE_GET_7,
    Core\CASE_GET_8,
    Core\CASE_SET,
    Core\CASE_SET_1,
    Core\CASE_SET_2,
    Core\CASE_SET_3,
    Core\CASE_SET_4,
};

# # # # # # # # # # # # # # # # # # # #

echoSection('Array (string key) of arrays');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$measurement->start();
$arraysOf = [];
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $valueInfo = valueOfInfo(CASE_CREATE, $i);
    $arraysOf[$valueInfo] = [
        $valueInfo,
        valueOfFirst($i),
        $i,
    ];
}
unset($valueInfo);
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_1);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element[0];
        $valueFirst = $element[1];
        $valueSecond = $element[2];
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
echoResults();



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
echoResults();



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
echoResults();



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
echoResults();



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $element[0];
        $valueFirst = $element[1];
        $valueSecond = $element[2];
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_7);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $arraysOf[$key][0];
        $valueFirst = $arraysOf[$key][1];
        $valueSecond = $arraysOf[$key][2];
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_8);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach (array_keys($arraysOf) as $key) {
        $valueInfo = $arraysOf[$key][0];
        $valueFirst = $arraysOf[$key][1];
        $valueSecond = $arraysOf[$key][2];
    }
}
$measurement->stop();
echoResults($measurement);



$arraysOfCopy = $arraysOf;

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $arraysOf[$key][0] = valueOfInfo(CASE_SET_1, $i);
        $arraysOf[$key][1] = valueOfFirst($i);
        $arraysOf[$key][2] = $i;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => &$element) {
        $element[0] = valueOfInfo(CASE_SET_2, $i);
        $element[1] = valueOfFirst($i);
        $element[2] = $i;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    $arraysOf = array_map(
        function(array $element) use ($i): array {
            $element[0] = valueOfInfo(CASE_SET_3, $i);
            $element[1] = valueOfFirst($i);
            $element[2] = $i;
            return $element;
        },
        $arraysOf
    );
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_4);
unset($element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    array_walk(
        $arraysOf,
        function(array &$element) use ($i): bool {
            $element[0] = valueOfInfo(CASE_SET_4, $i);
            $element[1] = valueOfFirst($i);
            $element[2] = $i;
            return true;
        }
    );
}
$measurement->stop();
echoResults($measurement);
