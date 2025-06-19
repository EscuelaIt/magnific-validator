<?php

namespace Escuelait\Tests\MagnificValidator;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\MagnificValidator;

class MagnificValidatorTest extends TestCase {

  #[Test]
  public function inputIsAlwaysValidWhenRulesAreNotDefined() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('miguel@escuela.it');
    $this->assertTrue($result);
  }

  #[Test]
  public function itValidatesCorrectEmails() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('miguel@escuela.it', ['email']);
    $this->assertTrue($result);
  }

  #[Test]
  public function itValidatesIncorrectEmails() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('@escuela.it', ['email']);
    $this->assertFalse($result);
  }
}