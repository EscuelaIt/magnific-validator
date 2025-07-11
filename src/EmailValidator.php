<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class EmailValidator implements Validator
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'email';
    }

    public function validate(mixed $value): array
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false
            ? []
            : ['The input should be an email'];
    }
}
