<?php

namespace Molovo\Prompt;

class Prompt
{
    /**
     * An array of column lengths used to align rows in a table.
     *
     * @var int[]
     */
    private static $tableColumnLengths = [];

    /**
     * Output a string.
     *
     * @param string $msg The string to output
     */
    public static function output($msg, $terminator = "\n")
    {
        echo $msg.$terminator;
    }

    /**
     * Output the header for a table.
     *
     * @param array $columns The columns in the table
     */
    public static function tableHeader(array $columns)
    {
        static::$tableColumnLengths = array_values($columns);
        $row                        = static::tableRow(array_keys($columns), true);

        $separator = ANSI::fg(str_pad('', array_sum(static::$tableColumnLengths), '='), ANSI::GRAY);
        static::output($separator);
        static::output($row);
        static::output($separator);
    }

    /**
     * Output a row within a table.
     *
     * @param array $columns The columns in the row
     * @param bool  $return  Whether value should be returned or printed
     */
    public static function tableRow(array $columns, $return = false)
    {
        $output = [];

        foreach ($columns as $index => $value) {
            $output[] = str_pad(' '.$value, static::$tableColumnLengths[$index]);
        }

        $row = implode(ANSI::fg('|', ANSI::GRAY), $output);

        if ($return) {
            return $row;
        }

        static::output($row);
    }
}
