<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

use InvalidArgumentException;

class ValidatorsFactory
{
    public function create(mixed $rules)
    {
        if (!is_string($rules) && !$this->isAssociativeArray($rules) && !$this->isNumericArrayOfStrings($rules)) {
            throw(new InvalidArgumentException("Not valid input to create a validator"));
        }
        if (is_string($rules)) {
            $validatorStrategyFactory = new ValidatorsStrategyFactory();
            return new ($validatorStrategyFactory->matchedValidator($rules))($rules);
        }
        if ($this->isAssociativeArray($rules)) {
            return new FormValidator($rules);
        }
        if ($this->isNumericArrayOfStrings($rules)) {
            return new FieldValidator($rules);
        }
    }

    private function isAssociativeArray($rules): bool
    {
        $associativeArrayValidator = new AssociativeArrayValidator();
        return count($associativeArrayValidator->validate($rules)) === 0;
    }

    private function isNumericArrayOfStrings($rules): bool
    {
        $stringsArrayValidator = new StringsArrayValidator();
        return count($stringsArrayValidator->validate($rules)) === 0;
    }
}
