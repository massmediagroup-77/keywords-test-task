<?php

namespace App\Helper;

class StringHelper
{
    /**
     * @param string $string
     * @return array
     */
    public static function getWordsFromString(string $string): array
    {
        // removing punctuation marks
        $string = str_replace(
            [
                '.',
                ',',
                '-',
                '?',
                '!',
            ],
            ' ',
            $string
        );

        // removing spaces at the beginning and end of the line
        $string = trim($string);

        // removing multiple spaces
        $string = preg_replace('/\s+/', ' ', $string);

        return explode(' ', $string);
    }
}