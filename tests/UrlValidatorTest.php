<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\UrlValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UrlValidatorTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectUrls()
    {
        $urlValidator = new UrlValidator();
        $errors = $urlValidator->validate('http://example.com');
        $this->assertEmpty($errors);
    }

    #[Test]
    public function itValidatesIncorrectUrls()
    {
        $urlValidator = new UrlValidator();
        $errors = $urlValidator->validate('url:invalida');
        $this->assertNotEmpty($errors);
        $this->assertContains('The input should be an url', $errors);
    }
}
