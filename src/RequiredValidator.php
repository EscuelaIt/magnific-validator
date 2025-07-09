<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class RequiredValidator implements ValidationInterface
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'required';
    }

    public function validate(mixed $value): array
    {
        return (! is_null($value) && $value !== '')
            ? []
            : ['The input is required'];
    }
}
