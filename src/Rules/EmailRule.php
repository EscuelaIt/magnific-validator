<?php

namespace Escuelait\MagnificValidator\Rules;

class EmailRule implements ValidationRule {

  public function validate(mixed $input) : bool {
    return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
  }

  public function message() : string {
    return 'The input should be an email';
  }
  
}