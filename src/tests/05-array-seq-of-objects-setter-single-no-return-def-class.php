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
require_once(ABS_PATH . '/classes/SetterSingleNoReturnDefClass.php');

# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterSingleNoReturnDefClass)');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$measurement->start();
/** @var SetterSingleNoReturnDefClass[] $arraysOf */
$arraysOf = [];
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new SetterSingleNoReturnDefClass();
    $element->setInfo(valueOfInfo(CASE_CREATE, $i));
    $element->setFirst(valueOfFirst($i));
    $element->setSecond($i);
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
        $arraysOf[$key]->setInfo(valueOfInfo(CASE_SET_1, $i));
        $arraysOf[$key]->setFirst(valueOfFirst($i));
        $arraysOf[$key]->setSecond($i);
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
unset($key, $element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    foreach ($arraysOf as $key => &$element) {
        $element->setInfo(valueOfInfo(CASE_SET_2, $i));
        $element->setFirst(valueOfFirst($i));
        $element->setSecond($i);
    }
}
$measurement->stop();
echoResults($measurement);



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
unset($element);
$measurement->start();
for ($i = 0; $i < REPETITIONS_SET; $i++) {
    array_map(
        function(SetterSingleNoReturnDefClass $element) use ($i): SetterSingleNoReturnDefClass {
            $element->setInfo(valueOfInfo(CASE_SET_3, $i));
            $element->setFirst(valueOfFirst($i));
            $element->setSecond($i);
            return $element;
        },
        $arraysOf
    );
}
$measurement->stop();
echoResults($measurement);
