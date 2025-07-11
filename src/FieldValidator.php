<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class FieldValidator implements Validator
{
    private $rules;

    public function __construct($rules)
    {
        assert(count((new StringsArrayValidator())->validate($rules)) === 0, 'Not valid rules for FieldValidator');

        $this->rules = $rules;
    }

    public function validate($value): array
    {
        $validators = (new ValidatorsStrategyFactory())->createValidators($this->rules);
        $fieldErrors = [];
        foreach ($validators as $validator) {
            $fieldErrors = array_merge($fieldErrors, $validator->validate($value));
        }
        return $fieldErrors;
    }
}
