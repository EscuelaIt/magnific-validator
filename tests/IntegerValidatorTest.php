<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\IntegerValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IntegerValidatorTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectIntegers()
    {
        $integerValidator = new IntegerValidator();

        $this->assertTrue($integerValidator->validate(123));
        $this->assertTrue($integerValidator->validate('456'));
        $this->assertTrue($integerValidator->validate(0));
        $this->assertTrue($integerValidator->validate(-789));
    }

    #[Test]
    public function itValidatesIncorrectIntegers()
    {
        $integerValidator = new IntegerValidator();

        $this->assertFalse($integerValidator->validate(12.34));
        $this->assertFalse($integerValidator->validate('abc'));
        $this->assertFalse($integerValidator->validate('123abc'));
        $this->assertFalse($integerValidator->validate(null));
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $integerValidator = new IntegerValidator();
        $this->assertEquals('The input should be an integer', $integerValidator->message());
    }
}
