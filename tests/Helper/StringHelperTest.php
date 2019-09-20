<?php

namespace App\Tests\Helper;

use App\Helper\StringHelper;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class StringHelperTest extends TestCase
{
    private const TEST_STRING_1 = 'Lorem ipsum dolor sit amet.';
    private const TEST_STRING_2 = 'Lorem, ipsum dolor - sit amet.';
    private const TEST_STRING_3 = 'Lorem - ipsum dolor sit amet.';

    private const EXPECTED_RESULT = [
        'Lorem',
        'ipsum',
        'dolor',
        'sit',
        'amet',
    ];

    /**
     * @dataProvider provideTestData
     */
    public function testGetWordsFromString($string)
    {
        $result = StringHelper::getWordsFromString($string);

        $this->assertEquals(
            self::EXPECTED_RESULT,
            $result
        );
    }

    public function provideTestData()
    {
        return [
            [
                'content' => self::TEST_STRING_1,
            ],
            [
                'content' => self::TEST_STRING_2,
            ],
            [
                'content' => self::TEST_STRING_3,
            ],
        ];
    }
}