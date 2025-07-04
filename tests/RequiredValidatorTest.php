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
        $result = $requiredValidator->validate('something');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesNotRequired()
    {
        $requiredValidator = new RequiredValidator();
        $result = $requiredValidator->validate('');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $requiredValidator = new RequiredValidator();
        $this->assertEquals('The input is required', $requiredValidator->message());
    }
}
