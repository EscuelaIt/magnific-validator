<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class MaxValidator implements ValidationInterface
{
    private int $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function validate(mixed $value): array
    {
        if (is_numeric($value)) {
            return $value <= $this->max ? [] : ["The input should be {$this->max} or less"];
        }
        return mb_strlen($value) <= $this->max ? [] : ["The input length should be {$this->max} or less"];
    }
}
