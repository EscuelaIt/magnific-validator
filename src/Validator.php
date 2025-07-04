<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

use Escuelait\MagnificValidator\Rules\RuleParser;

class Validator
{
    private array $errors;

    public function validateValue($value, array $rules = [])
    {
        $this->errors = [];

        foreach ((new RuleParser())->parseRules($rules) as $rule) {
            if (! $rule->validate($value)) {
                $this->errors[] = $rule->message();
            }
        }
        return $this->errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate($values, $rules)
    {
        $errors = [];
        foreach ($rules as $key => $rule) {
            $valueErrors = $this->validateValue($values[$key], $rule);
            if (count($valueErrors) > 0) {
                $errors[$key] = $valueErrors;
            }
        }
        return $errors;
    }

}
