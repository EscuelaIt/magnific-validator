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
              [
                  [
                      'email' => 'miguel@escuela.it',
                  ],
                  [
                      'email' => [],
                  ],
              ],
              [
                  [
                      'email' => 'miguel@escuela.it',
                  ],
                  [
                      'email' => ['email'],
                  ],
              ],
              [
                  [
                      'name' => 'EscuelaIT',
                  ],
                  [
                      'name' => ['required'],
                  ],
              ],
              [
                  [
                      'email' => 'alvaro@escuela.it',
                  ],
                  [
                      'email' => ['email', 'required'],
                  ],
              ],
              [
                  [
                      'url' => 'https://escuela.it',
                  ],
                  [
                      'url' => ['url', 'required'],
                  ],
              ],
              [
                  [
                      'url' => 'https://escuela.it/algo',
                  ],
                  [
                      'url' => ['url'],
                  ],
              ],
              [
                  [
                      'comment' => 'Algo que quiero validar',
                  ],
                  [
                      'comment' => ['required', 'max:40'],
                  ],
              ],
              [
                  [
                      'years' => '80',
                  ],
                  [
                      'years' => ['integer', 'required', 'max:100'],
                  ],
              ],
              [
                  [
                      'url' => 'https://escuela.it',
                  ],
                  [
                      'url' => ['url', 'required', 'max:200'],
                  ],
              ],
              [
                  [
                      'cantidad' => 34,
                  ],
                  [
                      'cantidad' => ['required', 'integer'],
                  ],
              ],
          ];
    }

    #[Test]
    #[DataProvider('validInputProvider')]
    public function itValidatesCorrectInput($input, $rules)
    {
        $validator =  new Validator($rules);
        $errors = $validator->validate($input);
        $this->assertEmpty($errors);
    }

    public static function invalidInputProvider(): array
    {
        return [
            [
                ['email' => '@escuela.it'],
                ['email' => ['email']],
            ],
            [
                ['name' => ''],
                ['name' => ['required']],
            ],
            [
                ['email' => 'no_es_un_email'],
                ['email' => ['required', 'email']],
            ],
            [
                ['email' => 'no_es_un_email'],
                ['email' => ['email', 'required']],
            ],
            [
                ['website' => 'escuela.it'],
                ['website' => ['url', 'required']],
            ],
            [
                ['comment' => 'Algo que quiero validar'],
                ['comment' => ['required', 'max:10']],
            ],
            [
                ['age' => '234a'],
                ['age' => ['required', 'integer']],
            ],
            [
                ['quantity' => ''],
                ['quantity' => ['integer']],
            ],
            [
                ['score' => 1],
                ['score' => ['required', 'max:0']],
            ],
        ];
    }


    #[Test]
    #[DataProvider('invalidInputProvider')]
    public function itDontValidatesIncorrectInput($input, $rules)
    {
        $validator =  new Validator($rules);
        $errors = $validator->validate($input);
        $this->assertNotEmpty($errors);
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
        $validator =  new Validator($dataRules);
        $errors = $validator->validate($data);
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
        $validator =  new Validator($dataRules);
        $errors = $validator->validate($data);
        $this->assertNotEmpty($errors);
    }

    #[Test]
    public function itRecivesAnExceptionWhenRuleIsNotReal()
    {
        $validator =  new Validator(['comment' => ['required', 'not_a_real_rule']]);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown rule: not_a_real_rule');

        $validator->validate(['comment' => 'something']);
    }

    #[Test]
    public function itInformsValidationErrors()
    {
        $validator =  new Validator(['email' => ['email', 'required']]);
        $errors = $validator->validate(
            ['email' => '']
        );
        $this->assertNotEmpty($errors);
        $this->assertContains('The input should be an email', $errors['email']);
        $this->assertContains('The input is required', $errors['email']);
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
        $validator =  new Validator($rules);
        $errors = $validator->validate($data);
        $this->assertNotEmpty($errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('password', $errors);
        $this->assertEquals('The input should be an email', $errors['email'][0]);
        $this->assertEquals('The input length should be 16 or less', $errors['password'][0]);
    }
}
