<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\RequiredValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequiredValidatorTest extends TestCase
{
    #[Test]
    public function itValidatesRequired()
    {
        $requiredValidator = new RequiredValidator();
        $errors = $requiredValidator->validate('something');
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itValidatesNotRequired()
    {
        $requiredValidator = new RequiredValidator();
        $errors = $requiredValidator->validate('');
        $this->assertNotEmpty($errors);
        $this->assertContains('The input is required', $errors);
    }
}
