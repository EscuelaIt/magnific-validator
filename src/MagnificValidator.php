<?php

namespace Escuelait\MagnificValidator;

class MagnificValidator {

  private array $errors;

  public function validateInput($input, array $rules = []) {
    $this->errors = [];
    foreach($rules as $rule) {
      if($rule == 'email') {
        $this->validateEmail($input);
      } elseif($rule == 'required') {
        $this->validateRequired($input);
      }
    }
    if(count($this->errors) > 0) {
      return false;
    }
    return true;
  }

  private function validateEmail($input) {
    if(filter_var($input, FILTER_VALIDATE_EMAIL) === false) {
      $this->errors[] = 'The input should be an email';
    }
  }

  private function validateRequired($input) {
    if(is_null($input) || $input == '') {
      $this->errors[] = 'The input is required';
    }
  }

}