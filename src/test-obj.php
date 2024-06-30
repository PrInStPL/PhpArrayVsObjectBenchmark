<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark;

error_reporting(E_ALL);

const ABS_PATH = __DIR__;

require_once('__autoload.php');

use PhpArrayVsObjectBenchmark\Classes\Test;
use PhpArrayVsObjectBenchmark\Classes\TestConfig;
use const PHP_VERSION_ID;


// --- CONFIG ---
TestConfig::setTestFast();
//TestConfig::setTestsExecutionDebugPrinting(true);
// END: --- CONFIG ---

require_once(ABS_PATH . '/Tests/ot-array-seq-of-arrays.php');
require_once(ABS_PATH . '/Tests/ot-array-string-of-arrays.php');
require_once(ABS_PATH . '/Tests/ot-ArrayObject-of-objects-PlainClass.php');
80200 <= PHP_VERSION_ID
    ? require_once(ABS_PATH . '/Tests/ot-ChainPlainClass802.php')
    : (new Test('ChainPlainClass802'))
;
require_once(ABS_PATH . '/Tests/ot-DsMap-seq-of-objects-PlainClass.php');
require_once(ABS_PATH . '/Tests/ot-DsMap-string-of-objects-PlainClass.php');
require_once(ABS_PATH . '/Tests/ot-DsVector-of-objects-PlainClass.php');
require_once(ABS_PATH . '/Tests/ot-SplFixedArray-of-objects-PlainClass.php');
require_once(ABS_PATH . '/Tests/ot-SplObjectStorage-of-objects-PlainClass.php');

Test::printResults();
