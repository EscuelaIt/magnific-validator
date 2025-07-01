<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\MagnificValidator;
use PHPUnit\Framework\Attributes\DataProvider;

class MagnificValidatorTest extends TestCase
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
        $validator =  new MagnificValidator();
        $result = $validator->validateInput($input, $rules);
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
        $validator =  new MagnificValidator();
        $result = $validator->validateInput($input, $rules);
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
        $validator =  new MagnificValidator();
        $result = $validator->validate($data, $dataRules);
        $this->assertTrue($result);
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
        $validator =  new MagnificValidator();
        $result = $validator->validate($data, $dataRules);
        $this->assertFalse($result);
    }

    #[Test]
    public function itRecivesAnExceptionWhenRuleIsNotReal()
    {
        $validator =  new MagnificValidator();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown rule: not_a_real_rule');

        $validator->validateInput('something', ['required', 'not_a_real_rule']);
    }

    #[Test]
    public function itInformsValidationErrors()
    {
        $validator =  new MagnificValidator();
        $result = $validator->validateInput('', ['email', 'required']);
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
        $validator =  new MagnificValidator();
        $result = $validator->validate($data, $rules);
        $this->assertFalse($result);
        $errors = $validator->getErrors();
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('password', $errors);
        $this->assertEquals('The input should be an email', $errors['email'][0]);
        $this->assertEquals('The input should be 16 or less', $errors['password'][0]);
    }
}
