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
        $result = $urlValidator->validate('http://example.com');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectUrls()
    {
        $urlValidator = new UrlValidator();
        $result = $urlValidator->validate('url:invalida');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $urlValidator = new UrlValidator();
        $this->assertEquals('The input should be an url', $urlValidator->message());
    }
}
