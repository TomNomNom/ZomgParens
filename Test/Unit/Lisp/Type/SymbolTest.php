<?php
namespace Test\Unit\Lisp\Type;

class SymbolTest extends \PHPUnit_Framework_TestCase {
  
  public function testName(){
    $symbol = new \Lisp\Type\Symbol('tom');
    $this->assertEquals('tom', $symbol->name(), "Symbol name should have been [tom]");
  }

  public function testNullEvaluate(){
    $symbol = new \Lisp\Type\Symbol('tom');
    $this->assertNull($symbol->evaluate(), "Symbol evaluation should have been null");
  }

  public function testNonNullEvaluate(){
    $symbol = new \Lisp\Type\Symbol('tom');
    $symbols = new \Lisp\SymbolTable([
      'tom' => 'My name is Tom'
    ]);
    $this->assertEquals('My name is Tom', $symbol->evaluate($symbols), "Symbol evaluation should have been [My name is Tom]");
  }

}
