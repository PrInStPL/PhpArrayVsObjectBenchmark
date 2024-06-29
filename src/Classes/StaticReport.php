<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Classes;

use InvalidArgumentException;

/**
 * For printing and saving table of test results
 */
abstract class StaticReport
{
    public const RESULT_TYPE_REPETITION = 'Repetitions';
    public const RESULT_TYPE_TIME = 'Time taken (seconds)';
    public const RESULT_TYPE_MEMORY = 'Memory used (bytes)';
    private const RESULT_TYPES = [
        self::RESULT_TYPE_REPETITION,
        self::RESULT_TYPE_TIME,
        self::RESULT_TYPE_MEMORY,
    ];

    public const PRINT_CLI = 0;
    public const PRINT_CSV = 1;
    public const LAYOUT_SECTIONS_UP = 0;
    public const LAYOUT_SECTIONS_LEFT = 1;



    /** @var array<non-empty-string, array<non-empty-string, array<non-empty-string, float|int|null>>> $results */
    protected static array $results = [];


    /**
     * @param string $name
     *
     * @return void
     */
    public static function addSection(string $name): void
    {
        self::$results[$name] = [];
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public static function addHeader(string $name): void
    {
        self::$results[array_key_last(self::$results)][$name] = [];
    }

    /**
     * @param string      $type
     * @param string|null $result
     *
     * @return void
     */
    public static function addResult(string $type, ?string $result): void
    {
        $section = array_key_last(self::$results);
        self::$results[$section][array_key_last(self::$results[$section])][$type] = $result;
    }

    /**
     * @param string $resultType
     *
     * @return string
     */
    protected static function resultTypeSimplify(string $resultType): string
    {
        switch ($resultType) {
            case self::RESULT_TYPE_MEMORY:
                return 'memory';
            case self::RESULT_TYPE_REPETITION:
                return 'count';
            case self::RESULT_TYPE_TIME:
                return 'time';
        }

        return $resultType;
    }

    /**
     * @param int  $format
     * @param int  $layout
     *
     * @return string
     */
    protected static function prepareResult(int $format = self::PRINT_CSV, int $layout = self::LAYOUT_SECTIONS_LEFT): string {
        $includedResultTypes = [
            self::RESULT_TYPE_TIME,
            self::RESULT_TYPE_MEMORY,
        ];

        $sections = [];
        $headers = [];

        $sectionNr = 0;
        foreach (self::$results as $sectionName => $sectionData) {
            $sectionNr++;
            $sections['TEST_' . $sectionNr] = $sectionName;
            $headers = array_unique(array_merge($headers, array_keys($sectionData)));
        }

        $data = '';

        if (self::PRINT_CLI === $format) {
            $columnsLength = [];
            $firstColumnLength = 0;

            $legendShortNameLength = 0;
            foreach ($sections as $sectionShortName => $sectionName) {
                $columnsLength[$sectionName] = strlen($sectionShortName);
                if ($columnsLength[$sectionName] > $legendShortNameLength) {
                    $legendShortNameLength = $columnsLength[$sectionName];
                }

                foreach (self::$results[$sectionName] as $results) {
                    foreach ($results as $type => $result) {
                        $rowLength = strlen($type);
                        if ($rowLength > $firstColumnLength) {
                            $firstColumnLength = $rowLength;
                        }

                        $fieldLength = strlen((string) $result);
                        if ($fieldLength > $columnsLength[$sectionName]) {
                            $columnsLength[$sectionName] = $fieldLength;
                        }
                    }
                }
            }


            $data .= 'Legend:' . PHP_EOL;
            foreach ($sections as $sectionShortName => $sectionName) {
                $data .= sprintf("  %-{$legendShortNameLength}s", $sectionShortName)
                    . ' --- ' . $sectionName . PHP_EOL
                ;
            }
            $data .= PHP_EOL;

            $data .= 'Results:' . PHP_EOL;
            $data .= sprintf("  %{$firstColumnLength}s", '|');
            foreach ($sections as $sectionShortName => $sectionName) {
                $data .= sprintf(" %$columnsLength[$sectionName]s |", $sectionShortName);
            }
            $data .= PHP_EOL;

            foreach ($headers as $header) {
                $data .= "$header\n";

                foreach (self::RESULT_TYPES as $resultType) {
                    $data .= sprintf("%{$firstColumnLength}s |", $resultType);

                    foreach ($columnsLength as $section => $columnLength) {
                        $data .= sprintf(
                            " %{$columnLength}s |",
                            (string) (self::$results[$section][$header][$resultType] ?? 'no test')
                        );
                    }

                    $data .= PHP_EOL;
                }

                $data .= PHP_EOL;
            }
        } elseif (self::PRINT_CSV === $format) {
            $limiter = '"';
            $delimiter = ',';

            $data .= $limiter . $limiter;

            if (self::LAYOUT_SECTIONS_UP === $layout) {
                foreach ($sections as $sectionName) {
                    $data .= $delimiter . $limiter . $sectionName . $limiter;
                }
                $data .= PHP_EOL;

                foreach ($headers as $header) {
                    foreach ($includedResultTypes as $resultType) {
                        $data .= $limiter . '[' . $header . '] ' . $resultType . $limiter;

                        foreach ($sections as $sectionName) {
                            $data .= $delimiter
                                . str_replace(
                                    '.',
                                    ',',
                                    $limiter . (
                                        self::$results[$sectionName][$header][$resultType]
                                        ?? 'no test'
                                    ) . $limiter
                                )
                            ;
                        }

                        $data .= PHP_EOL;
                    }
                }
            } elseif (self::LAYOUT_SECTIONS_LEFT === $layout) {
                foreach ($headers as $header) {
                    foreach ($includedResultTypes as $reportType) {
                        $data .= $delimiter . $limiter . $header . ' [' . $reportType . ']' . $limiter;
                    }
                }
                $data .= PHP_EOL;

                foreach ($sections as $sectionName) {
                    $data .= $limiter . $sectionName . $limiter;

                    foreach ($headers as $header) {
                        foreach ($includedResultTypes as $resultType) {
                            $data .= $delimiter
                                . str_replace(
                                    '.',
                                    ',',
                                    $limiter . (
                                        self::$results[$sectionName][$header][$resultType]
                                        ?? 'no test'
                                    ) . $limiter
                                )
                            ;
                        }
                    }

                    $data .= PHP_EOL;
                }
            } else {
                throw new InvalidArgumentException('Incorrect layout. Use class LAYOUT_SECTIONS_* constant.');
            }
        } else {
            throw new InvalidArgumentException('Incorrect format. Use class PRINT_* constant.');
        }

        return $data;
    }

    /**
     * @param int $format
     * @param int $layout
     *
     * @return void
     */
    public static function printResult(int $format = self::PRINT_CSV, int $layout = self::LAYOUT_SECTIONS_LEFT): void
    {
        echo self::prepareResult($format, $layout);
    }

    /**
     * @param string $fileName
     * @param int    $format
     * @param int    $layout
     *
     * @return void
     */
    public static function saveResult(
        string $fileName,
        int    $format = self::PRINT_CSV,
        int    $layout = self::LAYOUT_SECTIONS_LEFT
    ): void {
        if ($fileName[0] !== DIRECTORY_SEPARATOR) {
            $fileName = DIRECTORY_SEPARATOR . $fileName;
        }

        file_put_contents(
            ABS_PATH . $fileName,
            self::prepareResult($format, $layout)
        );
    }

    /**
     * @return void
     */
    public static function clearResults(): void
    {
        self::$results = [];
    }
}
