<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');

# # # # # # # # # # # # # # # # # # # #
echoSection('Array (string key) of arrays');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $arraysOf["$i"] = [
        valueOfInfo(CASE_CREATE, $i),
        valueOfFirst($i),
        $i,
    ];
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
        $valueInfo = $element[0];
        $valueFirst = $element[1];
        $valueSecond = $element[2];
    }
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
echoResults(null, null);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
echoResults(null, null);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
echoResults(null, null);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
echoResults(null, null);

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
unset($element, $valueInfo, $valueFirst, $valueSecond);
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < REPETITIONS_GET; $i++) {
    foreach ($arraysOf as $key => $element) {
        $valueInfo = $element[0];
        $valueFirst = $element[1];
        $valueSecond = $element[2];
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
        $valueInfo = $arraysOf[$key][0];
        $valueFirst = $arraysOf[$key][1];
        $valueSecond = $arraysOf[$key][2];
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
        $valueInfo = $arraysOf[$key][0];
        $valueFirst = $arraysOf[$key][1];
        $valueSecond = $arraysOf[$key][2];
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
        $arraysOf[$key][0] = valueOfInfo(CASE_SET, $i);
        $arraysOf[$key][1] = valueOfFirst($i);
        $arraysOf[$key][2] = $i;
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
        $element[0] = valueOfInfo(CASE_SET, $i);
        $element[1] = valueOfFirst($i);
        $element[2] = $i;
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
        function(array $element) use ($i): array {
            $element[0] = valueOfInfo(CASE_SET, $i);
            $element[1] = valueOfFirst($i);
            $element[2] = $i;
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);
