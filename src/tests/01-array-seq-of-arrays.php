<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/Measurement.php');

# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of arrays');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$measurement->start();
$arraysOf = [];
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $arraysOf[] = [
        valueOfInfo(CASE_CREATE, $i),
        valueOfFirst($i),
        $i,
    ];
}
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
unset($element, $valueInfo, $valueFirst, $valueSecond);
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
unset($element, $valueInfo, $valueFirst, $valueSecond);
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
unset($element, $valueInfo, $valueFirst, $valueSecond);
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



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
unset($element, $key);
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
unset($element, $key);
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
unset($element);
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
