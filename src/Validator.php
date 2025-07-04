<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

use Escuelait\MagnificValidator\Rules\RuleParser;

class Validator
{
    public function validate($values, $rules)
    {
        $errors = [];
        foreach ($rules as $fieldName => $ruleNames) {
            $valueErrors = $this->validateValue($values[$fieldName], $ruleNames);
            if (count($valueErrors) > 0) {
                $errors[$fieldName] = $valueErrors;
            }
        }
        return $errors;
    }

    private function validateValue($value, array $rulesNames = [])
    {
        $errors = [];
        foreach ((new RuleParser())->parseRules($rulesNames) as $rule) {
            if (! $rule->validate($value)) {
                $errors[] = $rule->message();
            }
        }
        return $errors;
    }

}
