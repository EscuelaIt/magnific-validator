<?php

namespace Escuelait\Tests\MagnificValidator;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\MagnificValidator;
use PHPUnit\Framework\Attributes\DataProvider;

class MagnificValidatorTest extends TestCase {

  public static function validInputProvider() :array {
    return [
      ['miguel@escuela.it', []],
      ['miguel@escuela.it', ['email']],
      ['EscuelaIT', ['required']],
      ['alvaro@escuela.it', ['email', 'required']],
      ['https://escuela.it', ['url', 'required']],
      ['https://escuela.it/algo', ['url']],
      ['Algo que quiero validar', ['required', 'max:40']],
      ['80', ['required', 'max:100']],
    ];
  }

  #[Test]
  #[DataProvider('validInputProvider')]
  public function itValidatesCorrectInput($input, $rules) {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput($input, $rules);
    $this->assertTrue($result);
  }

  public static function invalidInputProvider() :array {
    return [
      ['@escuela.it', ['email']],
      ['', ['required']],
      ['no_es_un_email', ['required', 'email']],
      ['no_es_un_email', ['email', 'required']],
      ['escuela.it', ['url', 'required']],
      ['Algo que quiero validar', ['required', 'max:10']],
      [1, ['required', 'max:0']],
    ];
  }

  #[Test]
  #[DataProvider('invalidInputProvider')]
  public function itDontValidatesIncorrectInput($input, $rules) {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput($input, $rules);
    $this->assertFalse($result);
  }

  #[Test]
  public function itRecivesAnExceptionWhenRuleIsNotReal() {
    $validator =  new MagnificValidator();
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Unknown rule: not_a_real_rule');

    $validator->validateInput('something', ['required', 'not_a_real_rule']);
  }

  #[Test]
  public function itInformsValidationErrors() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('', ['email', 'required']);
    $this->assertFalse($result);
    $errors = $validator->getErrors();
    $this->assertContains('The input should be an email', $errors);
    $this->assertContains('The input is required', $errors);
  }
}