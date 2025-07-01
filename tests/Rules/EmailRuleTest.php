<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator\Rules;

use Escuelait\MagnificValidator\Rules\EmailRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
