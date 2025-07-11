<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\ValidatorsFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidatorsFactoryTest extends TestCase {

  #[Test]
  public function itValidatesAForm() {
    $validatorFactory = new ValidatorsFactory();
    $validator = $validatorFactory->create([
      'email' => ['required', 'email'],
      'password' => ['required', 'max:16'],
    ]);
    $errors = $validator->validate([
      'email' => 'user@example.com',
      'password' => 'secret123',
    ]);
    $this->assertEmpty($errors);
  }

  #[Test]
  public function itValidatesAField() {
    $validatorFactory = new ValidatorsFactory();
    $validator = $validatorFactory->create(['required', 'email']);
    $errors = $validator->validate('user@example.com');
    $this->assertEmpty($errors);
  }

  #[Test]
  public function itDontValidatesAField() {
    $validatorFactory = new ValidatorsFactory();
    $validator = $validatorFactory->create(['required', 'url']);
    $errors = $validator->validate('user@example.com');
    $this->assertNotEmpty($errors);
    $this->assertContains('The input should be an url', $errors);
  }

  #[Test]
  public function itValidatesAValueWithASingleRule() {
    $validatorFactory = new ValidatorsFactory();
    $validator = $validatorFactory->create('required');
    $errors = $validator->validate('something');
    $this->assertEmpty($errors);
  }
  
  #[Test]
  public function itValidatesAValueWithASingleParametrizedRule() {
    $validatorFactory = new ValidatorsFactory();
    $validator = $validatorFactory->create('max:30');
    $errors = $validator->validate('something');
    $this->assertEmpty($errors);
  }

}