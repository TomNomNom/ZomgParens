<?php
namespace Test\Unit\Lisp\Type\Scalar;

class FloatTest extends \PHPUnit_Framework_TestCase {
  
  public function testValue(){
    $symbol = new \Lisp\Type\Scalar\Float(3.14);
    $this->assertEquals(3.14, $symbol->value(), "Float value should have been 3.14");
    $this->assertInternalType('float', $symbol->value(), "Float value should have been of type [float]");
  }

  public function testEvaluate(){
    $symbol = new \Lisp\Type\Scalar\Float(8.56);
    $this->assertEquals(8.56, $symbol->evaluate(), "Float evaluation should have been 8.56");
    $this->assertInternalType('float', $symbol->evaluate(), "Float evaluation should have been of type [float]");
  }

  public function testCastFromString(){
    $symbol = new \Lisp\Type\Scalar\Float("8.56");
    $this->assertEquals("8.56", $symbol->evaluate(), "Float evaluation should have been 8.56");
    $this->assertInternalType('float', $symbol->evaluate(), "String evaluation should have been cast to type [float]");
  }

}
