<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\RequiredRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequiredRuleTest extends TestCase
{
    #[Test]
    public function itValidatesRequired()
    {
        $requiredRule = new RequiredRule();
        $result = $requiredRule->validate('something');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesNotRequired()
    {
        $requiredRule = new RequiredRule();
        $result = $requiredRule->validate('');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $requiredRule = new RequiredRule();
        $this->assertEquals('The input is required', $requiredRule->message());
    }
}
