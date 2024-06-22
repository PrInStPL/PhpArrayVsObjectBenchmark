<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/core/functions.php');



echo PHP_EOL;
echo '-> PHP ver.: ' . PHP_VERSION . PHP_EOL;
echo '-> Date: ' . date('Y-m-d H:i:s') . PHP_EOL;
echo '-> The number of elements: ' . ELEMENTS_COUNT . PHP_EOL;
echo '-> The number of get repetitions: ' . REPETITIONS_GET . PHP_EOL;
echo '-> The number of set repetitions: ' . REPETITIONS_SET . PHP_EOL;
echo PHP_EOL;



// for memory init
$info = valueOfInfo('test', 0);
$time_start = $time_end = 0.0;
$memory_start = $memory_end = 0;
$valueInfo = valueOfInfo('test', 0);
$valueFirst = valueOfFirst(0);
$valueSecond = 0;
// END: for memory init



require_once(ABS_PATH . '/tests/01-array-seq-of-arrays.php');
require_once(ABS_PATH . '/tests/02-array-string-key-of-arrays.php');
require_once(ABS_PATH . '/tests/03-array-seq-of-objects-plain-class.php');
require_once(ABS_PATH . '/tests/04-array-string-key-of-objects-plain-class.php');
require_once(ABS_PATH . '/tests/05-array-seq-of-objects-setter-single-no-return-def-class.php');
require_once(ABS_PATH . '/tests/06-array-seq-of-object-setter-single-void-class.php');
require_once(ABS_PATH . '/tests/07-array-seq-of-objects-setter-single-return-class.php');
require_once(ABS_PATH . '/tests/08-array-seq-of-objects-setter-multiple-class.php');
require_once(ABS_PATH . '/tests/09-array-seq-of-objects-constructor-class.php');
require_once(ABS_PATH . '/tests/10-array-seq-of-objects-readonly-constructor-class.php');
