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
        $result = $maxValidator->validate(50);
        $this->assertTrue(($result));
    }

    #[Test]
    public function itDontValidatesValueGreaterThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $result = $maxValidator->validate(51);
        $this->assertFalse(($result));
    }

    #[Test]
    public function itDontValidatesValueStringGreaterThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $result = $maxValidator->validate('51');
        $this->assertFalse(($result));
    }

    #[Test]
    public function itValidatesValueStringLessThanMax()
    {
        $maxValidator = new MaxValidator(50);
        $result = $maxValidator->validate('5');
        $this->assertTrue(($result));
    }

    #[Test]
    public function itValidatesStringWithCorrectChars()
    {
        $maxValidator = new MaxValidator(5);
        $result = $maxValidator->validate('hola');
        $this->assertTrue(($result));
    }

    #[Test]
    public function itDontValidatesStringWithMoreChars()
    {
        $maxValidator = new MaxValidator(3);
        $result = $maxValidator->validate('hola');
        $this->assertFalse(($result));
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $maxValidator = new MaxValidator(3);
        $this->assertEquals("The input should be 3 or less", $maxValidator->message());
    }
}
