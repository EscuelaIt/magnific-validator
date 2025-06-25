<?php

namespace Escuelait\Tests\MagnificValidator\Rules;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\MagnificValidator\Rules\UrlRule;

class UrlRuleTest extends TestCase {

  #[Test]
  public function itValidatesCorrectUrls() {
    $urlRule = new UrlRule();
    $result = $urlRule->validate('http://example.com');
    $this->assertTrue($result);
  }

  #[Test]
  public function itValidatesIncorrectUrls() {
    $urlRule = new UrlRule();
    $result = $urlRule->validate('url:invalida');
    $this->assertFalse($result);
  }

  #[Test]
  public function itReturnsExpectedMessage() {
    $urlRule = new UrlRule();
    $this->assertEquals('The input should be an url', $urlRule->message());
  }
}