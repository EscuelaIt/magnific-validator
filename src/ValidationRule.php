<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

interface ValidationRule
{
    public function validate(mixed $value): bool;

    public function message(): string;
}
