<?php

namespace Escuelait\MagnificValidator\Rules;

class RuleParser {
  public function parseRules(array $rules) :array {
    return array_map(function ($rule) {
      return match(true) {
        $rule == 'email' => new EmailRule(),
        $rule == 'url' => new UrlRule(),
        $rule == 'integer' => new IntegerRule(),
        $rule == 'required' => new RequiredRule(),
        str_starts_with($rule, 'max:') => new MaxRule((int) substr($rule, 4)),
        default => throw new \InvalidArgumentException("Unknown rule: $rule"),
      };
    }, $rules);
  }
}