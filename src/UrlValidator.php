<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class UrlValidator implements ValidationInterface
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'url';
    }

    public function validate(mixed $input): array
    {
        return filter_var($input, FILTER_VALIDATE_URL) !== false
            ? []
            : ['The input should be an url'];
    }
}
