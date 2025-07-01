<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator\Rules;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\Rules\MaxRule;

class MaxRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectMax()
    {
        $maxRule = new MaxRule(50);
        $result = $maxRule->validate(50);
        $this->assertTrue(($result));
    }

    #[Test]
    public function itDontValidatesValueGreaterThanMax()
    {
        $maxRule = new MaxRule(50);
        $result = $maxRule->validate(51);
        $this->assertFalse(($result));
    }

    #[Test]
    public function itDontValidatesValueStringGreaterThanMax()
    {
        $maxRule = new MaxRule(50);
        $result = $maxRule->validate('51');
        $this->assertFalse(($result));
    }

    #[Test]
    public function itValidatesValueStringLessThanMax()
    {
        $maxRule = new MaxRule(50);
        $result = $maxRule->validate('5');
        $this->assertTrue(($result));
    }

    #[Test]
    public function itValidatesStringWithCorrectChars()
    {
        $maxRule = new MaxRule(5);
        $result = $maxRule->validate('hola');
        $this->assertTrue(($result));
    }

    #[Test]
    public function itDontValidatesStringWithMoreChars()
    {
        $maxRule = new MaxRule(3);
        $result = $maxRule->validate('hola');
        $this->assertFalse(($result));
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $maxRule = new MaxRule(3);
        $this->assertEquals("The input should be 3 or less", $maxRule->message());
    }
}
