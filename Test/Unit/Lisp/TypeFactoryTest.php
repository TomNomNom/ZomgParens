<?php
namespace Test\Unit\Lisp;

class TypeFactoryTest extends \PHPUnit_Framework_TestCase {
  
  public function testMake(){
    $tf = new \Lisp\TypeFactory();

    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $tf->make(3),       "Made type should have been \\Lisp\\Type\\Scalar\\Integer");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Float',   $tf->make(3.14),    "Made type should have been \\Lisp\\Type\\Scalar\\Float");
    $this->assertInstanceOf('\\Lisp\\Type\\Symbol',          $tf->make('+'),     "Made type should have been \\Lisp\\Type\\Symbol");
    $this->assertInstanceOf('\\Lisp\\Type\\Symbol',          $tf->make('hello'), "Made type should have been \\Lisp\\Type\\Symbol");
    $this->assertInstanceOf('\\Lisp\\Type\\Sexp',            $tf->make([]),      "Made type should have been \\Lisp\\Type\\Sexp");
  }

  public function testScalar(){
    $tf = new \Lisp\TypeFactory();

    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $tf->makeScalar(3),       "Made type should have been \\Lisp\\Type\\Scalar\\Integer");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Float',   $tf->makeScalar(3.14),    "Made type should have been \\Lisp\\Type\\Scalar\\Float");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\String',  $tf->makeScalar('+'),     "Made type should have been \\Lisp\\Type\\Scalar\\String");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\String',  $tf->makeScalar('hello'), "Made type should have been \\Lisp\\Type\\Scalar\\Symbol");
  }

  public function testMakeString(){
    $tf = new \Lisp\TypeFactory();
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\String', $tf->makeString('I am a string'), "Made type should have been \\Lisp\\Type\\Scalar\\String");
  }

  public function testMakeInteger(){
    $tf = new \Lisp\TypeFactory();
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $tf->makeInteger(4), "Made type should have been \\Lisp\\Type\\Scalar\\Integer");
  }

  public function testMakeFloat(){
    $tf = new \Lisp\TypeFactory();
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Float', $tf->makeFloat(4.45), "Made type should have been \\Lisp\\Type\\Scalar\\Float");
  }

  public function testMakeSymbol(){
    $tf = new \Lisp\TypeFactory();
    $this->assertInstanceOf('\\Lisp\\Type\\Symbol', $tf->makeSymbol('+'), "Made type should have been \\Lisp\\Type\\Symbol");
  }

  public function testMakeSexp(){
    $tf = new \Lisp\TypeFactory();
    $this->assertInstanceOf('\\Lisp\\Type\\Sexp', $tf->makeSexp([]), "Made type should have been \\Lisp\\Type\\Sexp");
  }


}
