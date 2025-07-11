<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use AssertionError;
use Escuelait\MagnificValidator\FieldValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FieldValidatorTest extends TestCase
{
    public static function validValuesDataProvider()
    {
        return [
            [
                ['required', 'email'],
                'mik@escuela.it',
            ],
            [
                ['required'],
                'escuela.it',
            ],
        ];
    }

    #[Test]
    #[DataProvider('validValuesDataProvider')]
    public function itRecivesAnExceptionWhenValidatingWithIncorrectInput($rules, $values)
    {
        $validator =  new FieldValidator($rules);
        $errors = $validator->validate($values);
        $this->assertEmpty($errors);
    }

    public static function invalidValuesDataProvider()
    {
        return [
            [['something', 'foo']],
            [null],
        ];
    }

    #[Test]
    #[DataProvider('invalidValuesDataProvider')]
    public function itDontValidates($values)
    {
        $validator =  new FieldValidator(['required', 'email']);
        $errors = $validator->validate($values);
        $this->assertNotEmpty($errors);
    }

    #[Test]
    public function itCantCreateFieldValidatorWithInvalidRules() {
        $this->expectException(AssertionError::class);
        new FieldValidator(344);
    }

}
