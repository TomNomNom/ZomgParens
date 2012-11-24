<?php
namespace Test\Unit\Lisp\Type;

class SexpTest extends \PHPUnit_Framework_TestCase {
  
  public function testLength(){
    $sexp = new \Lisp\Type\Sexp([]);
    $this->assertEquals(0, $sexp->length(), "Sexp length should have been 0");

    $sexp = new \Lisp\Type\Sexp([
      new \Lisp\Type\Scalar\String("I am a string"),
      new \Lisp\Type\Scalar\String("I am a string too")
    ]);
    $this->assertEquals(2, $sexp->length(), "Sexp length should have been 2");
  }

  public function testItemFetch(){
    $sexp = new \Lisp\Type\Sexp([]);
    $this->assertEquals(0, $sexp->length(), "Sexp length should have been 0");

    $stringOne = new \Lisp\Type\Scalar\String("I am a string");
    $stringTwo = new \Lisp\Type\Scalar\String("I am a string too");
    $sexp = new \Lisp\Type\Sexp([$stringOne, $stringTwo]);

    $this->assertEquals($stringOne, $sexp->item(0), "Return item should have matched first passed string");
    $this->assertEquals($stringTwo, $sexp->item(1), "Return item should have matched second passed string");
  }

  public function testPush(){
    $sexp = new \Lisp\Type\Sexp([]);
    $this->assertEquals(0, $sexp->length(), "Sexp length should have been 0");

    $sexp = new \Lisp\Type\Sexp([$stringOne]);
    $sexp = new \Lisp\Type\Sexp([
      new \Lisp\Type\Scalar\String("I am a string"),
    ]);

    $this->assertEquals(1, $sexp->length(), "Sexp length should have been 1");

    $sexp->push(new \Lisp\Type\Scalar\String("I am a string too"));

    $this->assertEquals(2, $sexp->length(), "Sexp length should have been 2");
  }

  public function testEvaluateNull(){
    $sexp = new \Lisp\Type\Sexp([]);
    $this->assertNull($sexp->evaluate(), "Sexp should have evaluated to null");
  }

  public function testEvaluateBasic(){
    $symbols = new \Lisp\SymbolTable([
      '+' => function($a, $b){
        return $a + $b;
      }
    ]);
    $sexp = new \Lisp\Type\Sexp([
      new \Lisp\Type\Symbol('+'),
      new \Lisp\Type\Scalar\Integer('6'),
      new \Lisp\Type\Scalar\Integer('7')
    ]);

    $this->assertEquals(13, $sexp->evaluate($symbols)->evaluate(), "Sexp should have evaluated to 13");
  }

  public function testEvaluateRescurseOnce(){
    $symbols = new \Lisp\SymbolTable([
      '+' => function($a, $b){
        return $a + $b;
      },
      '-' => function($a, $b){
        return $a - $b;
      }
    ]);
    $sexp = new \Lisp\Type\Sexp([
      new \Lisp\Type\Symbol('+'),
      new \Lisp\Type\Scalar\Integer('2'),
      new \Lisp\Type\Scalar\Integer('3')
    ]);
  }


}
