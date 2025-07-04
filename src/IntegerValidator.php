<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class IntegerValidator implements ValidationInterface
{
    public function validate(mixed $input): array
    {
        return filter_var($input, FILTER_VALIDATE_INT) !== false
            ? []
            : ['The input should be an integer'];
    }
}
