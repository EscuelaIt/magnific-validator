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

        $this->assertEmpty($integerValidator->validate(123));
        $this->assertEmpty($integerValidator->validate('456'));
        $this->assertEmpty($integerValidator->validate(0));
        $this->assertEmpty($integerValidator->validate(-789));
    }

    #[Test]
    public function itValidatesIncorrectIntegers()
    {
        $integerValidator = new IntegerValidator();

        $this->assertNotEmpty($integerValidator->validate(12.34));
        $this->assertNotEmpty($integerValidator->validate('abc'));
        $this->assertNotEmpty($integerValidator->validate('123abc'));
        $this->assertNotEmpty($integerValidator->validate(null));

        foreach ([
            12.34,
            'abc',
            '123abc',
            null,
        ] as $input) {
            $errors = $integerValidator->validate($input);
            $this->assertContains('The input should be an integer', $errors);
        }
    }
}
