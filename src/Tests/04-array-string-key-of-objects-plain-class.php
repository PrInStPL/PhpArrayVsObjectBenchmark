<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection PhpParameterByRefIsNotUsedAsReferenceInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Tests;

require_once(ABS_PATH . '/Core/constants.php');
require_once(ABS_PATH . '/Core/functions.php');

use PhpArrayVsObjectBenchmark\Classes\Measurement;
use PhpArrayVsObjectBenchmark\Classes\PlainClass;
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

// # # # # # # # # # # # # # # # # # # # #

echoSection('Array (string key) of objects (PlainClass)');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$measurement->start();
/** @var array<non-empty-string, PlainClass> $arraysOf */
$arraysOf = [];
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $valueInfo = valueOfInfo(CASE_CREATE, $i);
    $element = new PlainClass();
    $element->info = $valueInfo;
    $element->first = valueOfFirst($i);
    $element->second = $i;
    $arraysOf[$valueInfo] = $element;
}
unset($valueInfo);
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_1);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->info;
        $valueFirst = $element->first;
        $valueSecond = $element->second;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->getInfo();
        $valueFirst = $element->getFirst();
        $valueSecond = $element->getSecond();
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        [$valueInfo, $valueFirst, $valueSecond] = $element->getAll();
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->getInfoByTrait();
        $valueFirst = $element->getFirstByTrait();
        $valueSecond = $element->getSecondByTrait();
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        [$valueInfo, $valueFirst, $valueSecond] = $element->getAllByTrait();
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $element->info;
        $valueFirst = $element->first;
        $valueSecond = $element->second;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_7);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $arraysOf[$key]->info;
        $valueFirst = $arraysOf[$key]->first;
        $valueSecond = $arraysOf[$key]->second;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_8);
unset($key, $element, $valueInfo, $valueFirst, $valueSecond);
$measurement->start();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach (array_keys($arraysOf) as $key) {
        $valueInfo = $arraysOf[$key]->info;
        $valueFirst = $arraysOf[$key]->first;
        $valueSecond = $arraysOf[$key]->second;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $arraysOf[$key]->info = valueOfInfo(CASE_SET_1, $i);
        $arraysOf[$key]->first = valueOfFirst($i);
        $arraysOf[$key]->second = $i;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => &$element) {
        $element->info = valueOfInfo(CASE_SET_2, $i);
        $element->first = valueOfFirst($i);
        $element->second = $i;
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
unset($element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    $arraysOf = array_map(
        function(PlainClass $element) use ($i): PlainClass {
            $element->info = valueOfInfo(CASE_SET_3, $i);
            $element->first = valueOfFirst($i);
            $element->second = $i;
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
        function(PlainClass &$element) use ($i): bool {
            $element->info = valueOfInfo(CASE_SET_4, $i);
            $element->first = valueOfFirst($i);
            $element->second = $i;
            return true;
        }
    );
}
$measurement->stop();
echoResults($measurement);
