<?php

namespace Escuelait\MagnificValidator;

use Escuelait\MagnificValidator\Rules\RuleParser;

class MagnificValidator {

  private array $errors;

  public function validateInput($input, array $rules = []) {
    $this->errors = [];

    $ruleParser = new RuleParser();
    $ruleObjects = $ruleParser->parseRules($rules);

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

  
  
}