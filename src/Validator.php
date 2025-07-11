<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

interface Validator
{
    public function validate(mixed $value): array;
}
