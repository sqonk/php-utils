<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{
  public function testMultipop()
  {
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, ',', 2);
    $this->assertSame('1,2,3,4', $str);
    $this->assertSame(['5', '6'], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, ',', -1);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, ',', 0);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, '=', 2);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, ',', 6);
    $this->assertSame('', $str);
    $this->assertSame(['1', '2', '3', '4', '5', '6'], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multipop($str, ',', 7);
    $this->assertSame('', $str);
    $this->assertSame(['1', '2', '3', '4', '5', '6'], $popped);
        
    $str = "dave&=jane&=jenny&=phil";
    $popped = str_multipop($str, '&=', 2);
    $this->assertSame('dave&=jane', $str);
    $this->assertSame(['jenny', 'phil'], $popped);
  }
    
  public function testMultishift()
  {
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, ',', 2);
    $this->assertSame('3,4,5,6', $str);
    $this->assertSame(['1', '2'], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, ',', -1);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, ',', 0);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, '=', 2);
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame([], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, ',', 6);
    $this->assertSame('', $str);
    $this->assertSame(['1', '2', '3', '4', '5', '6'], $popped);
        
    $str = '1,2,3,4,5,6';
    $popped = str_multishift($str, ',', 7);
    $this->assertSame('', $str);
    $this->assertSame(['1', '2', '3', '4', '5', '6'], $popped);
        
    $str = "dave&=jane&=jenny&=phil";
    $popped = str_multishift($str, '&=', 2);
    $this->assertSame('jenny&=phil', $str);
    $this->assertSame(['dave', 'jane'], $popped);
  }
    
  public function testPop_ex()
  {
    $str = '1,2,3,4,5,6';
    $item = str_popex($str, ',');
    $this->assertSame('1,2,3,4,5', $str);
    $this->assertSame('6', $item);
        
    $str = '1,2,3,4,5,6';
    $item = str_popex($str, '=');
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame('', $item);
  }
    
  public function testShift_ex()
  {
    $str = '1,2,3,4,5,6';
    $item = str_shiftex($str, ',');
    $this->assertSame('2,3,4,5,6', $str);
    $this->assertSame('1', $item);
        
    $str = '1,2,3,4,5,6';
    $item = str_shiftex($str, '=');
    $this->assertSame('1,2,3,4,5,6', $str);
    $this->assertSame('', $item);
  }
    
  public function testClean(): void
  {
    $exp = "'ab\"c-12...3";
        
    # test Windows-1252 char removal.
    $input = chr(145)."ab".chr(147)."c".chr(150)."12".chr(133)."3";
    $this->assertSame(expected:$exp, actual:str_clean($input));
        
    # test UTF-8 char removal
    $input = "\xe2\x80\x98ab\xe2\x80\x9cc\xe2\x80\x9312\xe2\x80\xa63";
    $this->assertSame(expected:$exp, actual:str_clean($input));
  }
}
