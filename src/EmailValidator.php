<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class EmailValidator implements ValidationInterface
{
    public function validate(mixed $input): bool
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function message(): string
    {
        return 'The input should be an email';
    }

}
