<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
  public function testFirst()
  {
    $arr = [1, 2, 3];
    $this->assertSame(1, array_first($arr));
  }

  public function testLast()
  {
    $arr = [1, 2, 3];
    $this->assertSame(3, array_last($arr));
  }

  public function testHead(): void
  {
    $arr = [1, 2, 3, 4, 5, 6];

    $this->assertEquals(expected: [1, 2], actual: array_head($arr, amount: 2));
    $this->assertEquals(expected: [1, 2, 3], actual: array_head($arr, amount: 3));
    $this->assertEquals(expected: [1, 2, 3, 4, 5, 6], actual: array_head($arr, amount: 6));
    $this->assertEquals(expected: [1, 2, 3, 4, 5, 6], actual: array_head($arr, amount: 7));

    $this->expectException(\Exception::class);
    array_head($arr, amount: 0);
  }

  public function testTail(): void
  {
    $arr = [1, 2, 3, 4, 5, 6];

    $this->assertEquals(expected: [5, 6], actual: array_tail($arr, amount: 2));
    $this->assertEquals(expected: [4, 5, 6], actual: array_tail($arr, amount: 3));
    $this->assertEquals(expected: [1, 2, 3, 4, 5, 6], actual: array_tail($arr, amount: 6));
    $this->assertEquals(expected: [1, 2, 3, 4, 5, 6], actual: array_tail($arr, amount: 7));

    $this->expectException(\Exception::class);
    array_tail($arr, amount: 0);
  }

  public function testMultiPop()
  {
    $arr = [1, 2, 3, 4];
    $items = array_multipop($arr, 2);
    $this->assertSame([1, 2], $arr);
    $this->assertSame([4, 3], $items);

    $arr = [1, 2, 3, 4, 5, 6, 7];
    $items = array_multipop($arr, 4);
    $this->assertSame([1, 2, 3], $arr);
    $this->assertSame([7, 6, 5, 4], $items);
  }

  public function testMultiShift()
  {
    $arr = [1, 2, 3, 4];
    $items = array_multishift($arr, 2);
    $this->assertSame([3, 4], $arr);
    $this->assertSame([1, 2], $items);

    $arr = [1, 2, 3, 4, 5, 6, 7];
    $items = array_multishift($arr, 4);
    $this->assertSame([5, 6, 7], $arr);
    $this->assertSame([1, 2, 3, 4], $items);
  }

  public function testArrayChooce(): void
  {
    $this->assertSame(expected: null, actual: array_choose([]), message: 'Empty array returns null');

    $arr = [1, 2, 3];
    $val = array_choose($arr);
    $this->assertContains(haystack: $arr, needle: $val);
  }
}
