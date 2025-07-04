<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class RulesFactory
{
    public function createRules(array $rules): array
    {
        return array_map(function ($rule) {
            return match(true) {
                $rule === 'email' => new EmailValidator(),
                $rule === 'url' => new UrlValidator(),
                $rule === 'integer' => new IntegerValidator(),
                $rule === 'required' => new RequiredValidator(),
                str_starts_with($rule, 'max:') => new MaxValidator((int) substr($rule, strlen('max:'))),
                default => throw new \InvalidArgumentException("Unknown rule: $rule"),
            };
        }, $rules);
    }
}
