<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

interface ValidationInterface
{
    public function validate(mixed $value): bool;

    public function message(): string;
}
