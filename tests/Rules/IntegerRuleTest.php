<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator\Rules;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\Rules\IntegerRule;

class IntegerRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectIntegers()
    {
        $integerRule = new IntegerRule();

        $this->assertTrue($integerRule->validate(123));
        $this->assertTrue($integerRule->validate('456'));
        $this->assertTrue($integerRule->validate(0));
        $this->assertTrue($integerRule->validate(-789));
    }

    #[Test]
    public function itValidatesIncorrectIntegers()
    {
        $integerRule = new IntegerRule();

        $this->assertFalse($integerRule->validate(12.34));
        $this->assertFalse($integerRule->validate('abc'));
        $this->assertFalse($integerRule->validate('123abc'));
        $this->assertFalse($integerRule->validate(null));
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $integerRule = new IntegerRule();
        $this->assertEquals('The input should be an integer', $integerRule->message());
    }
}
