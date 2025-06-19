<?php

namespace Escuelait\MagnificValidator;

class MagnificValidator {

  public function validateInput($input, array $rules = []) {
    foreach($rules as $rule) {
      if($rule == 'email') {
        return $this->validateEmail($input);
      }
    }
    return true;
  }

  private function validateEmail($input) {
    return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
  }
}