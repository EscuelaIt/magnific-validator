<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public static function validInputProvider(): array
    {
        return [
          ['miguel@escuela.it', []],
          ['miguel@escuela.it', ['email']],
          ['EscuelaIT', ['required']],
          ['alvaro@escuela.it', ['email', 'required']],
          ['https://escuela.it', ['url', 'required']],
          ['https://escuela.it/algo', ['url']],
          ['Algo que quiero validar', ['required', 'max:40']],
          ['80', ['integer', 'required', 'max:100']],
          ['https://escuela.it', ['url', 'required', 'max:200']],
          [34, ['required', 'integer']],
        ];
    }

    #[Test]
    #[DataProvider('validInputProvider')]
    public function itValidatesCorrectInput($input, $rules)
    {
        $validator =  new Validator();
        $result = $validator->validateValue($input, $rules);
        $this->assertTrue($result);
    }

    public static function invalidInputProvider(): array
    {
        return [
          ['@escuela.it', ['email']],
          ['', ['required']],
          ['no_es_un_email', ['required', 'email']],
          ['no_es_un_email', ['email', 'required']],
          ['escuela.it', ['url', 'required']],
          ['Algo que quiero validar', ['required', 'max:10']],
          ['234a', ['required', 'integer']],
          ['', ['integer']],
          [1, ['required', 'max:0']],
        ];
    }

    #[Test]
    #[DataProvider('invalidInputProvider')]
    public function itDontValidatesIncorrectInput($input, $rules)
    {
        $validator =  new Validator();
        $result = $validator->validateValue($input, $rules);
        $this->assertFalse($result);
    }

    public static function validDataProvider(): array
    {
        return [
          [
            [
              'email' => 'miguel@escuela.it',
              'password' => 'secret',
            ],
            [
              'email' => ['required', 'email'],
              'password' => ['required', 'max:16'],
            ],
          ],
        ];
    }

    #[Test]
    #[DataProvider('validDataProvider')]
    public function itValidatesCorrectData($data, $dataRules)
    {
        $validator =  new Validator();
        $errors = $validator->validate($data, $dataRules);
        $this->assertEmpty($errors);
    }


    public static function invalidDataProvider(): array
    {
        return [
          [
            [
              'email' => 'escuela.it',
              'password' => 'secret',
            ],
            [
              'email' => ['required', 'email'],
              'password' => ['required', 'max:16'],
            ],
          ],
        ];
    }

    #[Test]
    #[DataProvider('invalidDataProvider')]
    public function itDontValidatesIncorrectData($data, $dataRules)
    {
        $validator =  new Validator();
        $errors = $validator->validate($data, $dataRules);
        $this->assertNotEmpty($errors);
    }

    #[Test]
    public function itRecivesAnExceptionWhenRuleIsNotReal()
    {
        $validator =  new Validator();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown rule: not_a_real_rule');

        $validator->validateValue('something', ['required', 'not_a_real_rule']);
    }

    #[Test]
    public function itInformsValidationErrors()
    {
        $validator =  new Validator();
        $result = $validator->validateValue('', ['email', 'required']);
        $this->assertFalse($result);
        $errors = $validator->getErrors();
        $this->assertContains('The input should be an email', $errors);
        $this->assertContains('The input is required', $errors);
    }

    #[Test]
    public function itGetErrorsOnInvalidData()
    {
        $data = [
              'email' => 'escuela.it',
              'password' => 'sdsdsdsdsdsdasdasdasdsada sdasd asdfsdf sdsdf sd',
        ];
        $rules = [
              'email' => ['required', 'email'],
              'password' => ['required', 'max:16'],
        ];
        $validator =  new Validator();
        $errors = $validator->validate($data, $rules);
        $this->assertNotEmpty($errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('password', $errors);
        $this->assertEquals('The input should be an email', $errors['email'][0]);
        $this->assertEquals('The input should be 16 or less', $errors['password'][0]);
    }
}
