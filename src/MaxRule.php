<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class MaxRule implements ValidationRule
{
    private int $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function validate(mixed $value): bool
    {
        if (is_numeric($value)) {
            return $value <= $this->max;
        }
        return mb_strlen($value) <= $this->max;
    }

    public function message(): string
    {
        return "The input should be {$this->max} or less";
    }
}
