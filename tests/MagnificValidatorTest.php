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

  #[Test]
  public function itValidatesRequiredInput() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('EscuelaIT', ['required']);
    $this->assertTrue($result);
  }

  #[Test]
  public function itValidatesRequiredInputIsNotProvided() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('', ['required']);
    $this->assertFalse($result);
  }

  #[Test]
  public function itValidatesRequiredAndEmailInput() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('alvaro@escuela.it', ['email', 'required']);
    $this->assertTrue($result);
  }

  #[Test]
  public function itValidatesIncorrectRequiredAndEmailInput() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('no_es_un_email', ['required', 'email']);
    $this->assertFalse($result);
  }

  #[Test]
  public function itValidatesIncorrectEmailAndRequiredInput() {
    $validator =  new MagnificValidator();
    $result = $validator->validateInput('no_es_un_email', ['email', 'required']);
    $this->assertFalse($result);
  }
}