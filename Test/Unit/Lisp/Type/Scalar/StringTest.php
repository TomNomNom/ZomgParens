<?php
namespace Test\Unit\Lisp\Type\Scalar;

class StringTest extends \PHPUnit_Framework_TestCase {
  
  public function testValue(){
    $symbol = new \Lisp\Type\Scalar\String("I am a string");
    $this->assertEquals("I am a string", $symbol->value(), "Float value should have been [I am a string]");
    $this->assertInternalType('string', $symbol->value(), "String value should have been of type [string]");
  }

  public function testEvaluate(){
    $symbol = new \Lisp\Type\Scalar\String("I am a string");
    $this->assertEquals("I am a string", $symbol->evaluate(), "Float evaluation should have been [I am a string]");
    $this->assertInternalType('string', $symbol->evaluate(), "String evaluation should have been of type [string]");
  }
}
