<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Core;

require_once(ABS_PATH . '/Core/functions.php');



// for memory init
$info = valueOfInfo('test', 0);
$time_start = $time_end = 0.0;
$memory_start = $memory_end = 0;
$valueInfo = valueOfInfo('test', 0);
$valueFirst = valueOfFirst(0);
$valueSecond = 0;
// END: for memory init



require_once(ABS_PATH . '/Tests/01-array-seq-of-arrays.php');
require_once(ABS_PATH . '/Tests/02-array-string-key-of-arrays.php');
require_once(ABS_PATH . '/Tests/03-array-seq-of-objects-plain-class.php');
require_once(ABS_PATH . '/Tests/04-array-string-key-of-objects-plain-class.php');
require_once(ABS_PATH . '/Tests/05-array-seq-of-objects-setter-single-no-return-def-class.php');
require_once(ABS_PATH . '/Tests/06-array-seq-of-object-setter-single-void-class.php');
require_once(ABS_PATH . '/Tests/07-array-seq-of-objects-setter-single-return-class.php');
require_once(ABS_PATH . '/Tests/08-array-seq-of-objects-setter-multiple-class.php');
require_once(ABS_PATH . '/Tests/09-array-seq-of-objects-constructor-class.php');
require_once(ABS_PATH . '/Tests/10-array-seq-of-objects-readonly-constructor-class.php');
