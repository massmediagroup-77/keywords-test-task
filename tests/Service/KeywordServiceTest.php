<?php

namespace App\Tests\Service;

use App\Service\KeywordService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class KeywordServiceTest extends TestCase
{
    private const KEYWORDS_STRING = 'banana,apple';
    private const EXPECTED_RESULT = [
        'banana',
        'apple',
    ];

    public function testGetKeywordsArray()
    {
        $keywordService = new KeywordService(self::KEYWORDS_STRING);

        $this->assertEquals(
            self::EXPECTED_RESULT,
            $keywordService->getKeywordsArray()
        );
    }
}