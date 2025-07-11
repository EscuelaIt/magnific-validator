<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class ValidatorsFactory
{

    public function create(mixed $rules) {
        if(is_string($rules)) {
            $validatorStrategyFactory = new ValidatorsStrategyFactory();
            return new($validatorStrategyFactory->matchedValidator($rules))($rules);
        }
        if($this->isAssociativeArray($rules)) {
            return new FormValidator($rules);
        }
        if($this->isNumericArrayOfStrings($rules)) {
            return new FieldValidator($rules);
        }
    }

    private function isAssociativeArray(array $array): bool
    {
        if ([] === $array) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    private function isNumericArrayOfStrings(array $array): bool
    {
        // Verifica que las claves sean numéricas consecutivas
        if (array_keys($array) !== range(0, count($array) - 1)) {
            return false;
        }

        // Verifica que todos los valores sean strings
        foreach ($array as $value) {
            if (!is_string($value)) {
                return false;
            }
        }

        return true;
    }
}
