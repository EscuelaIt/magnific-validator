<?php

declare(strict_types=1);

namespace Escuelait\MagnificValidator;

class FieldValidator implements Validator {

  private $rules;

  public function __construct($rules)
  {
    $this->rules = $rules;
  }

  public function validate($value): array {
    $validators = (new ValidatorsStrategyFactory())->createValidators($this->rules);
    $fieldErrors = [];
    foreach($validators as $validator) {
      $fieldErrors = array_merge($fieldErrors, $validator->validate($value));
    }
    return $fieldErrors;
  }
}