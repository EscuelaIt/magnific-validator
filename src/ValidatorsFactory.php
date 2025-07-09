<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class ValidatorsFactory
{
    private $validationStrategies = [
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
            return new ($this->matchedStrategy($rule))($rule);
        }, $rules);
    }

    private function areRulesValid($rules)
    {
        foreach ($rules as $rule) {
            $matched = $this->matchedStrategy($rule);
            if (!$matched) {
                return false;
            }
        }
        return true;
    }

    private function matchedStrategy($rule)
    {
        foreach ($this->validationStrategies as $strategy) {
            if ($strategy::isRuleMatched($rule)) {
                return $strategy;
            }
        }
        return null;
    }
}
