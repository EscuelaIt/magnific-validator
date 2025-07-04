<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class UrlRule implements ValidationRule
{
    public function validate(mixed $input): bool
    {
        return filter_var($input, FILTER_VALIDATE_URL) !== false;
    }

    public function message(): string
    {
        return 'The input should be an url';
    }
}
