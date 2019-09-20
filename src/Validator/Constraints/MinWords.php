<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MinWords extends Constraint
{
    public $message = 'The string must contains at least {{ min_count }} words';
}