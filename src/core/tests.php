<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/constants.php');
require_once(ABS_PATH . '/core/functions.php');
require_once(ABS_PATH . '/traits/SingleGettersTrait.php');
require_once(ABS_PATH . '/traits/MultiGetterTrait.php');
require_once(ABS_PATH . '/classes/AbstractSingleGetterClass.php');
require_once(ABS_PATH . '/classes/AbstractMultiGetterClass.php');
require_once(ABS_PATH . '/classes/PlainClass.php');
require_once(ABS_PATH . '/classes/SetterSingleNoReturnDefClass.php');
require_once(ABS_PATH . '/classes/SetterSingleVoidClass.php');
require_once(ABS_PATH . '/classes/SetterSingleReturnClass.php');
require_once(ABS_PATH . '/classes/SetterMultipleClass.php');
require_once(ABS_PATH . '/classes/ConstructorClass.php');
if (80200 <= PHP_VERSION_ID) {
    require_once(ABS_PATH . '/classes/ReadonlyConstructorClass.php');
}

// for memory init
$info = valueOfInfo('test', 0);
$time_start = $time_end = 0.0;
$memory_start = $memory_end = 0;
$valueInfo = valueOfInfo('test', 0);
$valueFirst = valueOfFirst(0);
$valueSecond = 0;
// END: for memory init

echo PHP_EOL;
echo '-> PHP ver.: ' . PHP_VERSION . PHP_EOL;
echo '-> Date: ' . date('Y-m-d H:i:s') . PHP_EOL;
echo '-> The number of elements: ' . ELEMENTS_COUNT . PHP_EOL;
echo '-> The number of get repetitions: ' . REPETITIONS_GET . PHP_EOL;
echo '-> The number of set repetitions: ' . REPETITIONS_SET . PHP_EOL;
echo PHP_EOL;



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of arrays');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $arraysOf[] = [
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



// # # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (PlainClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var PlainClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new PlainClass();
    $element->info = valueOfInfo(CASE_CREATE, $i);
    $element->first = valueOfFirst($i);
    $element->second = $i;
    $arraysOf[] = $element;
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



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterSingleNoReturnDefClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var SetterSingleNoReturnDefClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new SetterSingleNoReturnDefClass();
    $element->setInfo(valueOfInfo(CASE_CREATE, $i));
    $element->setFirst(valueOfFirst($i));
    $element->setSecond($i);
    $arraysOf[] = $element;
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
        $arraysOf[$key]->setInfo(valueOfInfo(CASE_SET, $i));
        $arraysOf[$key]->setFirst(valueOfFirst($i));
        $arraysOf[$key]->setSecond($i);
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
        $element->setInfo(valueOfInfo(CASE_SET, $i));
        $element->setFirst(valueOfFirst($i));
        $element->setSecond($i);
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
        function(SetterSingleNoReturnDefClass $element) use ($i): SetterSingleNoReturnDefClass {
            $element->setInfo(valueOfInfo(CASE_SET, $i));
            $element->setFirst(valueOfFirst($i));
            $element->setSecond($i);
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterSingleVoidClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var SetterSingleVoidClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new SetterSingleVoidClass();
    $element->setInfo(valueOfInfo(CASE_CREATE, $i));
    $element->setFirst(valueOfFirst($i));
    $element->setSecond($i);
    $arraysOf[] = $element;
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
        $arraysOf[$key]->setInfo(valueOfInfo(CASE_SET, $i));
        $arraysOf[$key]->setFirst(valueOfFirst($i));
        $arraysOf[$key]->setSecond($i);
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
        $element->setInfo(valueOfInfo(CASE_SET, $i));
        $element->setFirst(valueOfFirst($i));
        $element->setSecond($i);
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
        function(SetterSingleVoidClass $element) use ($i): SetterSingleVoidClass {
            $element->setInfo(valueOfInfo(CASE_SET, $i));
            $element->setFirst(valueOfFirst($i));
            $element->setSecond($i);
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterSingleReturnClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var SetterSingleReturnClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = (new SetterSingleReturnClass())
        ->setInfo(valueOfInfo(CASE_CREATE, $i))
        ->setFirst(valueOfFirst($i))
        ->setSecond($i)
    ;
    $arraysOf[] = $element;
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
        $arraysOf[$key]
            ->setInfo(valueOfInfo(CASE_SET, $i))
            ->setFirst(valueOfFirst($i))
            ->setSecond($i)
        ;
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
        $element
            ->setInfo(valueOfInfo(CASE_SET, $i))
            ->setFirst(valueOfFirst($i))
            ->setSecond($i)
        ;
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
        function(SetterSingleReturnClass $element) use ($i): SetterSingleReturnClass {
            $element
                ->setInfo(valueOfInfo(CASE_SET, $i))
                ->setFirst(valueOfFirst($i))
                ->setSecond($i)
            ;
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (SetterMultipleClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var SetterMultipleClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new SetterMultipleClass();
    $element->set(
        valueOfInfo(CASE_CREATE, $i),
        valueOfFirst($i),
        $i
    );
    $arraysOf[] = $element;
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
        $arraysOf[$key]->set(
            valueOfInfo(CASE_SET, $i),
            valueOfFirst($i),
            $i
        );
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
        $element->set(
            valueOfInfo(CASE_SET, $i),
            valueOfFirst($i),
            $i
        );
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
        function(SetterMultipleClass $element) use ($i): SetterMultipleClass {
            $element->set(
                valueOfInfo(CASE_SET, $i),
                valueOfFirst($i),
                $i
            );
            return $element;
        },
        $arraysOf
    );
}
$time_end = microtime(true);
$memory_end = memory_get_usage();
echoResults($time_end - $time_start, $memory_end - $memory_start);



# # # # # # # # # # # # # # # # # # # #
echoSection('Array (seq) of objects (ConstructorClass)');

echoHeader(CASE_CREATE, ELEMENTS_COUNT);
unset($arraysOf, $element);
/** @var ConstructorClass[] $arraysOf */
$arraysOf = [];
$time_start = microtime(true);
$memory_start = memory_get_usage();
for ($i = 0; $i < ELEMENTS_COUNT; $i++) {
    $element = new ConstructorClass(
        valueOfInfo(CASE_CREATE, $i),
        valueOfFirst($i),
        $i
    );
    $arraysOf[] = $element;
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
        function(ConstructorClass $element) use ($i): ConstructorClass {
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
