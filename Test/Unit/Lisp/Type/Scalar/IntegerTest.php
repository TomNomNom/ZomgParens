<?php
namespace Test\Unit\Lisp\Type\Scalar;

class IntegerTest extends \PHPUnit_Framework_TestCase {
  
  public function testValue(){
    $symbol = new \Lisp\Type\Scalar\Integer(7);
    $this->assertEquals(7, $symbol->value(), "Integer value should have been 7");
    $this->assertInternalType('integer', $symbol->value(), "Integer value should have been of type [integer]");
  }

  public function testEvaluate(){
    $symbol = new \Lisp\Type\Scalar\Integer(8);
    $this->assertEquals(8, $symbol->evaluate(), "Integer evaluation should have been 8");
    $this->assertInternalType('integer', $symbol->evaluate(), "Integer evaluation should have been of type [integer]");
  }

  public function testCastFromString(){
    $symbol = new \Lisp\Type\Scalar\Integer("8");
    $this->assertEquals("8", $symbol->evaluate(), "Integer evaluation should have been 8");
    $this->assertInternalType('integer', $symbol->evaluate(), "String evaluation should have been cast to type [integer]");
  }

}
