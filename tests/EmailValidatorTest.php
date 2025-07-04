<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\EmailValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectEmails()
    {
        $emailValidator = new EmailValidator();
        $result = $emailValidator->validate('miguel@escuela.it');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectEmails()
    {
        $emailValidator = new EmailValidator();
        $result = $emailValidator->validate('@escuela.it');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $emailValidator = new EmailValidator();
        $this->assertEquals('The input should be an email', $emailValidator->message());
    }
}
