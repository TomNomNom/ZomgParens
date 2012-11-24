<?php
namespace Test\Unit\Lisp;

class EvaluatorTest extends \PHPUnit_Framework_TestCase {
  
  public function testBasic(){
    $tree = [
      new \Lisp\Type\Sexp([
        new \Lisp\Type\Symbol('+'),
        new \Lisp\Type\Scalar\Integer('2'),
        new \Lisp\Type\Scalar\Integer('3')
      ])
    ];
    $symbols = new \Lisp\SymbolTable([
      '+' => function($a, $b){
        return $a + $b;
      }
    ]);
    $e = new \Lisp\Evaluator($tree, $symbols); 

    $e->evaluate();

    $this->assertEquals(5, $e->lastReturnValue(), "Last return value should have been 5");
  }
}
