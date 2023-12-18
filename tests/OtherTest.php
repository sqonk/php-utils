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
  
  public function testConstrainToMin()
  {
      $this->assertSame(constrain(5, 6, 10), 6);
  }
  
  public function testConstrainToMax()
  {
      $this->assertSame(constrain(10.1, 6, 10), 10);
  }
  
  public function testNoConstrain()
  {
      $this->assertSame(constrain(7, 6, 10), 7);
  }
}