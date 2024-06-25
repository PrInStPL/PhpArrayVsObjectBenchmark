<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection PhpParameterByRefIsNotUsedAsReferenceInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/Measurement.php');
require_once(ABS_PATH . '/classes/SetterMultipleClass.php');

# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterMultipleClass)');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$measurement->start();
/** @var SetterMultipleClass[] $arraysOf */
$arraysOf = [];
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new SetterMultipleClass();
    $element->set(
        valueOfInfo(CASE_CREATE, $i),
        valueOfFirst($i),
        $i
    );
    $arraysOf[] = $element;
}
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
        $arraysOf[$key]->set(
            valueOfInfo(CASE_SET_1, $i),
            valueOfFirst($i),
            $i
        );
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => &$element) {
        $element->set(
            valueOfInfo(CASE_SET_2, $i),
            valueOfFirst($i),
            $i
        );
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
unset($element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    $arraysOf = array_map(
        function(SetterMultipleClass $element) use ($i): SetterMultipleClass {
            $element->set(
                valueOfInfo(CASE_SET_3, $i),
                valueOfFirst($i),
                $i
            );
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
        function(SetterMultipleClass &$element) use ($i): bool {
            $element->set(
                valueOfInfo(CASE_SET_4, $i),
                valueOfFirst($i),
                $i
            );
            return true;
        }
    );
}
$measurement->stop();
echoResults($measurement);
