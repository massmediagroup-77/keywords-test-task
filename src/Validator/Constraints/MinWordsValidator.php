<?php

namespace App\Validator\Constraints;

use App\Helper\StringHelper;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class MinWordsValidator extends ConstraintValidator
{
    private $minWordsCount;

    public function __construct(int $minWordsCount)
    {
        $this->minWordsCount = $minWordsCount;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof MinWords) {
            throw new UnexpectedTypeException($constraint, MinWords::class);
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!$this->isValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ min_count }}', $this->minWordsCount)
                ->addViolation();
        }
    }

    private function isValid($value): bool
    {
        $words = StringHelper::getWordsFromString($value);

        return count($words) >= $this->minWordsCount;
    }
}