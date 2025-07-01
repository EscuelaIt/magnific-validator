<?php

namespace Escuelait\Tests\MagnificValidator\Rules;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\Rules\EmailRule;

class EmailRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectEmails()
    {
        $emailRule = new EmailRule();
        $result = $emailRule->validate('miguel@escuela.it');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectEmails()
    {
        $emailRule = new EmailRule();
        $result = $emailRule->validate('@escuela.it');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $emailRule = new EmailRule();
        $this->assertEquals('The input should be an email', $emailRule->message());
    }
}
