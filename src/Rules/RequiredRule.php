<?php

namespace Escuelait\MagnificValidator\Rules;

class RequiredRule implements ValidationRule {
  
  public function validate(mixed $input) : bool {
    return ! is_null($input) && $input != '';
  }

  public function message() : string {
    return 'The input is required';
  }
  
}