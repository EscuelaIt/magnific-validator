<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class Validator
{
    public function validate($values, $rules): array
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
        $compositeErrors = [];
        foreach ((new ValidatorsFactory())->createValidators($rulesNames) as $validator) {
            $validatorErrors = $validator->validate($value);
            if (count($validatorErrors) !== 0) {
                foreach ($validatorErrors as $error) {
                    $compositeErrors[] = $error;
                }
            }
        }
        return $compositeErrors;
    }

}
