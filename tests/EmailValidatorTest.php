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
        $errors = $emailValidator->validate('miguel@escuela.it');
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itValidatesIncorrectEmails()
    {
        $emailValidator = new EmailValidator();
        $errors = $emailValidator->validate('@escuela.it');
        $this->assertNotEmpty($errors);
        $this->assertContains('The input should be an email', $errors);
    }
}
