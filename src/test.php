<?php /** @noinspection DuplicatedCode */
/** @noinspection PhpParameterByRefIsNotUsedAsReferenceInspection */

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark;

const ABS_PATH = __DIR__;
require_once('__autoload.php');

use PhpArrayVsObjectBenchmark\Classes\Measurement;
use PhpArrayVsObjectBenchmark\Classes\StaticReport;



// config
const FAST_TEST = true;
const ECHO_NUMBERS_ONLY = false;
/** @const ?int RESULTS_FORMAT Use: StaticReport::PRINT_CSV | StaticReport::PRINT_CLI */
const RESULTS_FORMAT = StaticReport::PRINT_CLI;
/** @const int RESULTS_LAYOUT Use: StaticReport::LAYOUT_SECTIONS_LEFT | StaticReport::LAYOUT_SECTIONS_UP */
const RESULTS_LAYOUT = StaticReport::LAYOUT_SECTIONS_LEFT;

/** @const int ELEMENTS_COUNT */
const ELEMENTS_COUNT = FAST_TEST ? 500 : 10000;
/** @const int REPETITIONS_GET */
const REPETITIONS_GET = FAST_TEST ? 100 : 5000;
/** @const int REPETITIONS_SET */
const REPETITIONS_SET = FAST_TEST ? 100 : 5000;
// END: config



echo PHP_EOL;
echo '-> PHP ver.: ' . PHP_VERSION . PHP_EOL;
echo '-> Date: ' . date('Y-m-d H:i:s') . PHP_EOL;
echo '-> The number of elements: ' . ELEMENTS_COUNT . PHP_EOL;
echo '-> The number of get repetitions: ' . REPETITIONS_GET . PHP_EOL;
echo '-> The number of set repetitions: ' . REPETITIONS_SET . PHP_EOL;
echo PHP_EOL;

($allTestsMeasurement = new Measurement())->start();
require_once('Core/tests.php');
$allTestsMeasurement->stop();

echo PHP_EOL . PHP_EOL . PHP_EOL;
if (is_int(RESULTS_FORMAT)) {
    echo '-> PHP ver.: ' . PHP_VERSION . PHP_EOL;
    echo '-> The number of elements: ' . ELEMENTS_COUNT . PHP_EOL;
    echo '-> The number of get repetitions: ' . REPETITIONS_GET . PHP_EOL;
    echo '-> The number of set repetitions: ' . REPETITIONS_SET . PHP_EOL;
    echo '-> Time taken (in seconds) by all tests: ' . $allTestsMeasurement->getTimeTaken() . PHP_EOL;
    echo '-> Memory used (in bytes) by all tests: ' . $allTestsMeasurement->getMemoryUsed() . PHP_EOL;
    echo PHP_EOL;
    StaticReport::printResult(RESULTS_FORMAT, RESULTS_LAYOUT);
} else {
    echo '-> Time taken (in seconds) by all tests: ' . $allTestsMeasurement->getTimeTaken() . PHP_EOL;
    echo '-> Memory used (in bytes) by all tests: ' . $allTestsMeasurement->getMemoryUsed() . PHP_EOL;
}

