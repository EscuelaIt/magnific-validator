<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class Validator
{
    public function validate($values, $rules)
    {
        $formErrors = [];
        foreach ($rules as $fieldName => $ruleNames) {
            $fieldErrors = $this->validateValue($values[$fieldName], $ruleNames);
            if (count($fieldErrors) > 0) {
                $formErrors[$fieldName] = $fieldErrors;
            }
        }
        return $formErrors;
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
