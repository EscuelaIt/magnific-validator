<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\MaxValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MaxValidatorTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectMax()
    {
        $maxValidator = new MaxValidator(50);
        $errors = $maxValidator->validate(50);
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itDontValidatesValueGreaterThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $errors = $maxValidator->validate(51);
        $this->assertNotEmpty($errors);
        $this->assertContains("The input should be 50 or less", $errors);
    }

    #[Test]
    public function itDontValidatesValueStringGreaterThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $errors = $maxValidator->validate('51');
        $this->assertNotEmpty($errors);
        $this->assertContains("The input should be 50 or less", $errors);
    }

    #[Test]
    public function itValidatesValueStringLessThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $errors = $maxValidator->validate('5');
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itValidatesStringWithCorrectChars()
    {
        $maxValidator = new MaxValidator(5);
        $errors = $maxValidator->validate('hola');
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itDontValidatesStringWithMoreChars()
    {
        $maxValidator = new MaxValidator(3);
        $errors = $maxValidator->validate('hola');
        $this->assertNotEmpty($errors);
        $this->assertContains("The input length should be 3 or less", $errors);
    }
}
