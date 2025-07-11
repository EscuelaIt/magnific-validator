<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class MaxValidator implements Validator
{
    private int $max;

    public static function isRuleMatched($rule): bool
    {
        return str_starts_with($rule, 'max:');
    }

    public function __construct(string $maxRule)
    {
        $this->max = (int) substr($maxRule, strlen('max:'));
    }

    public function validate(mixed $value): array
    {
        if (is_numeric($value)) {
            return $value <= $this->max ? [] : ["The input should be {$this->max} or less"];
        }
        return mb_strlen($value) <= $this->max ? [] : ["The input length should be {$this->max} or less"];
    }
}
