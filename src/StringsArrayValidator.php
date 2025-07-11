<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class StringsArrayValidator implements Validator
{
    public static function isRuleMatched($rule): bool
    {
        return $rule === 'strings_array';
    }

    public function validate(mixed $array): array
    {
        if(!is_array($array)) {
            return ['Input is not an array'];
        }

        // Verifica que las claves sean numéricas consecutivas
        if (array_keys($array) !== range(0, count($array) - 1)) {
            return ['Input is not a numeric array'];
        }

        // Verifica que todos los valores sean strings
        foreach ($array as $string) {
            if (!is_string($string)) {
                return ['Not array values are strings'];
            }
        }

        return [];
    }
}
