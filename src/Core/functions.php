<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Core;

require_once(ABS_PATH . '/Core/constants.php');

use PhpArrayVsObjectBenchmark\classes\Measurement;
use PhpArrayVsObjectBenchmark\classes\StaticReport;
use const PhpArrayVsObjectBenchmark\ABS_PATH;
use const PhpArrayVsObjectBenchmark\ECHO_NUMBERS_ONLY;



/**
 * For unify values
 *
 * @param string $case
 * @param int    $i
 *
 * @return string
 */
function valueOfInfo(string $case, int $i): string
{
    return "Some $i information in $i $case repetition";
}

/**
 * For unify values
 *
 * @param int $i
 *
 * @return string
 */
function valueOfFirst(int $i): string
{
    return sprintf('%015d', $i);
}

/**
 * @param string $info
 *
 * @return void
 */
function echoSection(string $info): void
{
    echo PHP_EOL . (ECHO_NUMBERS_ONLY ? '' : '########## ') . $info . (ECHO_NUMBERS_ONLY ? '' : ' ##########') . PHP_EOL;

    StaticReport::addSection($info);
}

/**
 * @param string $name
 * @param int    $repetitions
 * @param string $info
 *
 * @return void
 */
function echoHeader(string $name, int $repetitions, string $info = ''): void
{
    $nameInfo = $name . (empty($info) ? '' : " ($info)");
    $repetitions = number_format($repetitions, 0, '', ' ');

    echo PHP_EOL
        . (ECHO_NUMBERS_ONLY
            ? ''
            : "-> $nameInfo repetitions: "
        )
        . $repetitions
        . PHP_EOL;

    StaticReport::addHeader($nameInfo);
    StaticReport::addResult(StaticReport::RESULT_TYPE_REPETITION, $repetitions);
}

/**
 * @param Measurement|null $stat
 *
 * @return void
 */
function echoResults(?Measurement $stat = null): void
{
    $time = $stat ? (string) $stat->getTimeTaken() : null;
    $memory = $stat ? number_format($stat->getMemoryUsed(), 0, '', ' ') : null;

    echo (ECHO_NUMBERS_ONLY ? '' : 'Time taken (seconds): ') . $time . PHP_EOL
        . (ECHO_NUMBERS_ONLY ? '' : 'Memory used (bytes): ') . $memory . PHP_EOL;

    StaticReport::addResult(StaticReport::RESULT_TYPE_TIME, $time);
    StaticReport::addResult(StaticReport::RESULT_TYPE_MEMORY, $memory);
}
