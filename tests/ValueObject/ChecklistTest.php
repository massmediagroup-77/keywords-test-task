<?php

namespace App\Tests\ValueObject;

use App\ValueObject\Checklist;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ChecklistTest extends TestCase
{
    private const CONTENT_1 = 'fruits are really good for your health. You should eat at least 1 banana per day and 1 green apple.';
    private const CONTENT_2 = 'banana is good apple';
    private const CONTENT_3 = 'banana is good';

    private const KEYWORDS_1 = [
        'banana',
        'apple',
    ];
    private const KEYWORDS_2 = [
        'banana is good',
        'apple',
    ];
    private const KEYWORDS_3 = [
        'banana is good',
    ];


    /**
     * @dataProvider provideTestData
     */
    public function testProcess($content, $keywords, $result)
    {
        $checklist = new Checklist($content);
        $checklist->handle($keywords);

        $this->assertEquals($result['keywordsUsed'], $checklist->getKeywordsUsedCount());
        $this->assertEquals($result['averageKeywordsDensity'], $checklist->getAverageKeywordsDensity());
    }

    public function provideTestData()
    {
        return [
            [
                'content' => self::CONTENT_1,
                'keywords' => self::KEYWORDS_1,
                'result' => [
                    'keywordsUsed' => 2,
                    'averageKeywordsDensity' => 0.10,
                ],
            ],
            [
                'content' => self::CONTENT_2,
                'keywords' => self::KEYWORDS_2,
                'result' => [
                    'keywordsUsed' => 2,
                    'averageKeywordsDensity' => 1,
                ],
            ],
            [
                'content' => self::CONTENT_3,
                'keywords' => self::KEYWORDS_3,
                'result' => [
                    'keywordsUsed' => 1,
                    'averageKeywordsDensity' => 1,
                ],
            ],
        ];
    }
}