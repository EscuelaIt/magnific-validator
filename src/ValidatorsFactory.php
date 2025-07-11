<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class ValidatorsFactory
{
    private $validators = [
        EmailValidator::class,
        UrlValidator::class,
        IntegerValidator::class,
        RequiredValidator::class,
        MaxValidator::class,
    ];

    public function createValidators(array $rules): array
    {
        // assert($this->areRulesValid($rules), 'Not valid rules');
        if (!$this->areRulesValid($rules)) {
            throw new \InvalidArgumentException("Not valid rules");
        }

        return array_map(function ($rule) {
            return new ($this->matchedValidator($rule))($rule);
        }, $rules);
    }

    private function areRulesValid($rules)
    {
        foreach ($rules as $rule) {
            $matched = $this->matchedValidator($rule);
            if (!$matched) {
                return false;
            }
        }
        return true;
    }

    private function matchedValidator($rule)
    {
        foreach ($this->validators as $validator) {
            if ($validator::isRuleMatched($rule)) {
                return $validator;
            }
        }
        return null;
    }
}
