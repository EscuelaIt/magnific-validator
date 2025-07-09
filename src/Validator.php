<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class Validator implements ValidationInterface
{
    private $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate($values): array
    {
        $formErrors = [];
        foreach ($this->rules as $fieldName => $ruleNames) {
            $fieldErrors = $this->validateValue($values[$fieldName], $ruleNames);
            if (count($fieldErrors) > 0) {
                $formErrors[$fieldName] = $fieldErrors;
            }
        }
        return $formErrors;
    }

    private function validateValue($value, array $rulesNames = [])
    {
        $valueErrors = [];
        foreach ((new ValidatorsFactory())->createValidators($rulesNames) as $validator) {
            $validatorErrors = $validator->validate($value);
            if (count($validatorErrors) !== 0) {
                foreach ($validatorErrors as $error) {
                    $valueErrors[] = $error;
                }
            }
        }
        return $valueErrors;
    }

}
