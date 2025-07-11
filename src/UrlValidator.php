<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class UrlValidator implements Validator
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'url';
    }

    public function validate(mixed $value): array
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false
            ? []
            : ['The input should be an url'];
    }
}
