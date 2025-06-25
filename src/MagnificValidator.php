<?php

namespace Escuelait\MagnificValidator;

use Escuelait\MagnificValidator\Rules\MaxRule;
use Escuelait\MagnificValidator\Rules\UrlRule;
use Escuelait\MagnificValidator\Rules\EmailRule;
use Escuelait\MagnificValidator\Rules\RequiredRule;

class MagnificValidator {

  private array $errors;

  public function validateInput($input, array $rules = []) {
    $this->errors = [];

    $ruleObjects = $this->parseRules($rules);

    foreach($ruleObjects as $rule) {
      if(! $rule->validate($input)) {
        $this->errors[] = $rule->message();
      }
    }
    if(count($this->errors) > 0) {
      return false;
    }
    return true;
  }

  public function getErrors() {
    return $this->errors;
  }

  private function parseRules(array $rules) :array {
    return array_map(function ($rule) {
      return match(true) {
        $rule == 'email' => new EmailRule(),
        $rule == 'url' => new UrlRule(),
        $rule == 'required' => new RequiredRule(),
        str_starts_with($rule, 'max:') => new MaxRule((int) substr($rule, 4)),
        default => throw new \InvalidArgumentException("Unknown rule: $rule"),
      };
    }, $rules);
  }
  
}