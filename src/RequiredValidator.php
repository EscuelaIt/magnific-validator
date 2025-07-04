<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class RequiredValidator implements ValidationInterface
{
    public function validate(mixed $input): bool
    {
        return ! is_null($input) && $input !== '';
    }

    public function message(): string
    {
        return 'The input is required';
    }

}
