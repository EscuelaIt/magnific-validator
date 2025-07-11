<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class AssociativeArrayValidator implements Validator
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'associative_array';
    }

    public function validate(mixed $value): array
    {
        if (!is_array($value)) {
            return ['The input is not an array'];
        }

        if ([] === $value) {
            return ['The input has not keys'];
        }

        return array_keys($value) !== range(0, count($value) - 1)
            ? []
            : ['The input is not an associative array'];
    }
}
