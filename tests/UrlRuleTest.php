<?php

declare(strict_types=1);

namespace Escuelait\Tests\MagnificValidator;

use Escuelait\MagnificValidator\UrlRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UrlRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectUrls()
    {
        $urlRule = new UrlRule();
        $result = $urlRule->validate('http://example.com');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectUrls()
    {
        $urlRule = new UrlRule();
        $result = $urlRule->validate('url:invalida');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnsExpectedMessage()
    {
        $urlRule = new UrlRule();
        $this->assertEquals('The input should be an url', $urlRule->message());
    }
}
