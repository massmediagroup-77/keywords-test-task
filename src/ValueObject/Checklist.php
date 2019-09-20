<?php

namespace App\ValueObject;

use App\Helper\StringHelper;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Checklist
 * @package App\ValueObject
 *
 * @JMS\ExclusionPolicy("all")
 */
class Checklist
{
    /**
     * @Assert\NotBlank
     * @AppAssert\MinWords
     *
     * @JMS\Expose()
     */
    private $content;

    /**
     * @JMS\Expose()
     */
    private $keywordsUsedCount;

    private $keywordsUsed = [];

    /**
     * @JMS\Expose()
     */
    private $averageKeywordsDensity;


    /**
     * Checklist constructor.
     * @param string $content
     */
    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Checklist
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getKeywordsUsedCount(): ?int
    {
        return $this->keywordsUsedCount;
    }

    /**
     * @return float|null
     */
    public function getAverageKeywordsDensity(): ?float
    {
        return $this->averageKeywordsDensity;
    }

    /**
     * @param array $keywords
     * @return $this
     */
    public function handle(array $keywords): self
    {
        // searching used keywords
        foreach ($keywords as $keyword) {
            if (false === strpos($this->content, $keyword)) {
                continue;
            }

            if (in_array($keyword, $this->keywordsUsed)) {
                continue;
            }

            $this->keywordsUsed[] = $keyword;
        }

        $words = StringHelper::getWordsFromString($this->content);

        // finding count words in used keywords list
        $countWordsInKeyWords = array_reduce($this->keywordsUsed, function ($words, $item) {
            $words += count(StringHelper::getWordsFromString($item));

            return $words;
        }, 0);


        $this->keywordsUsedCount = count($this->keywordsUsed);


        $this->averageKeywordsDensity = number_format(
            $countWordsInKeyWords / count($words),
            2,
            '.',
            ''
        );

        return $this;
    }
}