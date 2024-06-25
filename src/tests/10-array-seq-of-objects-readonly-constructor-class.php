<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/classes/Measurement.php');
if (80200 <= PHP_VERSION_ID) {
    require_once(ABS_PATH . '/classes/ReadonlyConstructorClass.php');
}

// # # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (ReadonlyConstructorClass)');
$measurement = new Measurement();



echoHeader(CASE_CREATE, ELEMENTS_COUNT);
if (80200 <= PHP_VERSION_ID) {
    unset($arraysOf, $element);
    $measurement->start();
    /** @var ReadonlyConstructorClass[] $arraysOf */
    $arraysOf = [];
    for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
        $element = new ReadonlyConstructorClass(
            valueOfInfo(CASE_CREATE, $i),
            valueOfFirst($i),
            $i
        );
        $arraysOf[] = $element;
    }
    $measurement->stop();
    echoResults($measurement);
} else {
    echoResults();
    $arraysOf = [];
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_1);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
if (80200 <= PHP_VERSION_ID) {
    unset($element, $valueInfo, $valueFirst, $valueSecond);
    $measurement->start();
    for ($i = 0; $i < REPETITIONS_GET; $i++) {
        foreach ($arraysOf as $element) {
            [
                $valueInfo,
                $valueFirst,
                $valueSecond
            ] = $element->getAll();
        }
    }
    $measurement->stop();
    echoResults($measurement);
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
if (80200 <= PHP_VERSION_ID) {
    unset($element, $valueInfo, $valueFirst, $valueSecond);
    $measurement->start();
    for ($i = 0; $i < REPETITIONS_GET; $i++) {
        foreach ($arraysOf as $element) {
            [
                $valueInfo,
                $valueFirst,
                $valueSecond
            ] = $element->getAllByTrait();
        }
    }
    $measurement->stop();
    echoResults($measurement);
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_7);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_8);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults();
}



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
echoResults();



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
echoResults();



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
echoResults();



echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_4);
echoResults();
