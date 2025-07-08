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
        assert($this->areRulesValid($rules), 'Not valid rules');

        return array_map(function ($rule) {
            return new ($this->matchedRule($rule))($rule);
        }, $rules);
    }

    private function areRulesValid($rules)
    {
        foreach ($rules as $rule) {
            $matched = false;
            foreach ($this->validationStrategies as $strategy) {
                if ($strategy::isRuleMatched($rule)) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                return false;
            }
        }
        return true;
    }

    private function matchedRule($rule)
    {
        foreach ($this->validationStrategies as $strategy) {
            if ($strategy::isRuleMatched($rule)) {
                return $strategy;
            }
        }
    }
}
