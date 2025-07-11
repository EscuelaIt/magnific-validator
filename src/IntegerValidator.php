<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class IntegerValidator implements Validator
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'integer';
    }

    public function validate(mixed $value): array
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false
            ? []
            : ['The input should be an integer'];
    }
}
