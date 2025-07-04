<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class RequiredValidator implements ValidationInterface
{
    public function validate(mixed $input): array
    {
        return (! is_null($input) && $input !== '')
            ? []
            : ['The input is required'];
    }
}
