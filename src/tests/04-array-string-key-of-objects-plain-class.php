<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/PlainClass.php');

// # # # # # # # # # # # # # # # # # # # #
echoSection('Array (string key) of objects (PlainClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var array<non-empty-string, PlainClass> $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new PlainClass();
    $element->info = valueOfInfo(CASE_CREATE, $i);
    $element->first = valueOfFirst($i);
    $element->second = $i;
    $arraysOf[valueOfInfo(CASE_CREATE, $i)] = $element;
}
$memory_end = memory_get_usage();
$time_end = microtime(true);
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_1);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->info;
        $valueFirst = $element->first;
        $valueSecond = $element->second;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->getInfo();
        $valueFirst = $element->getFirst();
        $valueSecond = $element->getSecond();
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        [$valueInfo, $valueFirst, $valueSecond] = $element->getAll();
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        $valueInfo = $element->getInfoByTrait();
        $valueFirst = $element->getFirstByTrait();
        $valueSecond = $element->getSecondByTrait();
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $element) {
        [$valueInfo, $valueFirst, $valueSecond] = $element->getAllByTrait();
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $element->info;
        $valueFirst = $element->first;
        $valueSecond = $element->second;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_7);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $arraysOf[$key]->info;
        $valueFirst = $arraysOf[$key]->first;
        $valueSecond = $arraysOf[$key]->second;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_8);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach (array_keys($arraysOf) as $key) {
        $valueInfo = $arraysOf[$key]->info;
        $valueFirst = $arraysOf[$key]->first;
        $valueSecond = $arraysOf[$key]->second;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

$arraysOfCopy = $arraysOf;

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
unset($element);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $arraysOf[$key]->info = valueOfInfo(CASE_SET, $i);
        $arraysOf[$key]->first = valueOfFirst($i);
        $arraysOf[$key]->second = $i;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

unset($arraysOf);
$arraysOf = $arraysOfCopy;

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
unset($element);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => &$element) {
        $element->info = valueOfInfo(CASE_SET, $i);
        $element->first = valueOfFirst($i);
        $element->second = $i;
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

unset($arraysOf);
$arraysOf = $arraysOfCopy;

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    array_map(
        function(PlainClass $element) use ($i): PlainClass {
            $element->info = valueOfInfo(CASE_SET, $i);
            $element->first = valueOfFirst($i);
            $element->second = $i;
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);
