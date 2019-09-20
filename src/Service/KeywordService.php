<?php

namespace App\Service;

class KeywordService
{
    private $keywordsString;

    public function __construct(string $keywordsString)
    {
        $this->keywordsString = $keywordsString;
    }

    public function getKeywordsArray(): array
    {
        $string = trim($this->keywordsString);

        return explode(',', $string);
    }
}