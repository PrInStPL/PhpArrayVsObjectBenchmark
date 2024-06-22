<?php /** @noinspection PhpArrayAccessCanBeReplacedWithForeachValueInspection */
/** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
if (80200 <= PHP_VERSION_ID) {
    require_once(ABS_PATH . '/classes/ReadonlyConstructorClass.php');
}

// # # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (ReadonlyConstructorClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
if (80200 <= PHP_VERSION_ID) {
    unset($arraysOf, $element);
    /** @var ReadonlyConstructorClass[] $arraysOf */
    $arraysOf = [];
    $time_start = microtime(true);
    $memory_start = memory_get_usage();
    for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
        $element = new ReadonlyConstructorClass(
            valueOfInfo(CASE_CREATE, $i),
            valueOfFirst($i),
            $i
        );
        $arraysOf[] = $element;
    }
    $memory_end = memory_get_usage();
    $time_end = microtime(true);
    echoResults($time_end - $time_start, $memory_end - $memory_start);
} else {
    echoResults(null, null);
    $arraysOf = [];
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_1);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_2);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_3);
if (80200 <= PHP_VERSION_ID) {
    unset($element, $valueInfo, $valueFirst, $valueSecond);
    $time_start = microtime(true);
    $memory_start = memory_get_usage();
    for ($i = 0; $i < REPETITIONS_GET; $i++) {
        foreach ($arraysOf as $element) {
            [
                $valueInfo,
                $valueFirst,
                $valueSecond
            ] = $element->getAll();
        }
    }
    $time_end = microtime(true);
    $memory_end = memory_get_usage();
    echoResults($time_end - $time_start, $memory_end - $memory_start);
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_4);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_5);
if (80200 <= PHP_VERSION_ID) {
    unset($element, $valueInfo, $valueFirst, $valueSecond);
    $time_start = microtime(true);
    $memory_start = memory_get_usage();
    for ($i = 0; $i < REPETITIONS_GET; $i++) {
        foreach ($arraysOf as $element) {
            [
                $valueInfo,
                $valueFirst,
                $valueSecond
            ] = $element->getAllByTrait();
        }
    }
    $time_end = microtime(true);
    $memory_end = memory_get_usage();
    echoResults($time_end - $time_start, $memory_end - $memory_start);
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_6);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_7);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_GET, count($arraysOf) * REPETITIONS_GET, CASE_GET_8);
if (80200 <= PHP_VERSION_ID) {
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
} else {
    echoResults(null, null);
}

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_1);
echoResults(null, null);

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_2);
echoResults(null, null);

echoHeader(CASE_SET, count($arraysOf) * REPETITIONS_SET, CASE_SET_3);
echoResults(null, null);
