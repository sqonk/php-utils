<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class OtherTest extends TestCase
{
  function testBool2Str(): void 
  {
    $this->assertSame('true', bool2str(true));
    $this->assertSame('false', bool2str(false));
  }
}