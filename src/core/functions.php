<?php

declare(strict_types=1);

if (!defined('ABS_PATH')) {
    exit('You have to run main test file!');
}

require_once(ABS_PATH . '/classes/StaticReport.php');

/**
 * For unify values
 *
 * @param string $case
 * @param int    $i
 *
 * @return string
 */
function valueOfInfo(string $case, int $i): string {
    return "Some $i information in $i $case repetition";
}

/**
 * For unify values
 *
 * @param int $i
 *
 * @return string
 */
function valueOfFirst(int $i): string {
    return sprintf('%015d', $i);
}

/**
 * @param string $info
 *
 * @return void
 */
function echoSection(string $info): void {
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
function echoHeader(string $name, int $repetitions, string $info = ''): void {
    $nameInfo = $name . (empty($info) ? '' : " ($info)");
    echo PHP_EOL
        . (ECHO_NUMBERS_ONLY
            ? ''
            : "-> $nameInfo repetitions: "
        )
        . $repetitions
        . PHP_EOL
    ;

    StaticReport::addHeader($nameInfo);
    StaticReport::addResult(StaticReport::RESULT_TYPE_REPETITION, $repetitions);
}

/**
 * @param float|null $time
 * @param int|null   $memory
 *
 * @return void
 */
function echoResults(?float $time, ?int $memory): void {
    echo (ECHO_NUMBERS_ONLY ? '' : 'Time taken (seconds): ') . $time . PHP_EOL
        . (ECHO_NUMBERS_ONLY ? '' : 'Memory used (bytes): ') . $memory . PHP_EOL
    ;

    StaticReport::addResult(StaticReport::RESULT_TYPE_TIME, $time);
    StaticReport::addResult(StaticReport::RESULT_TYPE_MEMORY, $memory);
}
