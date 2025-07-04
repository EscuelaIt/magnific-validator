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

        $ruleObjects = (new RuleParser())->parseRules($rules);

        foreach ($ruleObjects as $rule) {
            if (! $rule->validate($value)) {
                $this->errors[] = $rule->message();
            }
        }
        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate($values, $rules)
    {
        $errors = [];
        foreach ($rules as $key => $rule) {
            if (! $this->validateValue($values[$key], $rule)) {
                $errors[$key] = $this->errors;
            }
        }
        return $errors;
    }

}
