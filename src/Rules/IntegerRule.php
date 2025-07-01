<?php

namespace Escuelait\MagnificValidator\Rules;

class IntegerRule implements ValidationRule
{
    public function validate(mixed $input): bool
    {
        return filter_var($input, FILTER_VALIDATE_INT) !== false;
    }

    public function message(): string
    {
        return 'The input should be an integer';
    }
}
