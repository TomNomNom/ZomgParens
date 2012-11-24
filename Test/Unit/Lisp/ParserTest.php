<?php
namespace Test\Unit\Lisp;

class ParserTest extends \PHPUnit_Framework_TestCase {
  
  public function testTypes(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump 1 "A string" 3.14 (+ 2 4))';
    $tree = $parser->parse($code);

    $this->assertInternalType('array', $tree, "Returned tree should be an array");
    $this->assertEquals(1, sizeOf($tree), "Returned tree should contain only one s-expression");

    $sexp = $tree[0];
    $this->assertInstanceOf('\\Lisp\\Type\\Sexp', $sexp, "S-expression should be of type \\Lisp\\Type\\Sexp");

    $this->assertInstanceOf('\\Lisp\\Type\\Symbol',          $sexp->item(0), "First item in s-expression should be of type \\Lisp\\Type\\Symbol");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $sexp->item(1), "Second item in s-expression should be of type \\Lisp\\Type\\Scalar\\Integer");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\String',  $sexp->item(2), "Third item in s-expression should be of type \\Lisp\\Type\\Scalar\\String");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Float',   $sexp->item(3), "Fourth item in s-expression should be of type \\Lisp\\Type\\Scalar\\Float");
    $this->assertInstanceOf('\\Lisp\\Type\\Sexp',            $sexp->item(4), "Fifth item in s-expression should be of type \\Lisp\\Type\\Sexp");

    $subSexp = $sexp->item(4);
    $this->assertInstanceOf('\\Lisp\\Type\\Symbol',          $subSexp->item(0), "First item in sub s-expression should be of type \\Lisp\\Type\\Symbol");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $subSexp->item(1), "Second item in sub s-expression should be of type \\Lisp\\Type\\Scalar\\Integer");
    $this->assertInstanceOf('\\Lisp\\Type\\Scalar\\Integer', $subSexp->item(2), "Third item in sub s-expression should be of type \\Lisp\\Type\\Scalar\\Integer");
  }

  public function testStringEscapes(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump "I said \"Hello!\"")';
    $tree = $parser->parse($code);
    $this->assertEquals('I said "Hello!"', $tree[0]->item(1)->value(), "Parser did not escape double-quotes in string correctly");

    $code = "(var_dump 'I said \'Hello!\'')";
    $tree = $parser->parse($code);
    $this->assertEquals("I said 'Hello!'", $tree[0]->item(1)->value(), "Parser did not escape single-quotes in string correctly");
  }


  public function testMultipleSexps(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump 1 2 3)(var_dump 4 5 6)';
    $tree = $parser->parse($code);
    $this->assertEquals(2, sizeOf($tree), "Tree should contain 2 s-expressions");

    $this->assertInstanceOf('\\Lisp\\Type\\Sexp', $tree[0], "S-expression should be of type \\Lisp\\Type\\Sexp");
    $this->assertInstanceOf('\\Lisp\\Type\\Sexp', $tree[1], "S-expression should be of type \\Lisp\\Type\\Sexp");
  }

  public function testWhitespaceTolerant(){
    $parser = new \Lisp\Parser();

    $code = '
      (var_dump 1 
                2 
                3)
      (var_dump 4 "Multi-line 
                   string")
    ';
    $tree = $parser->parse($code);

    $this->assertEquals(2, sizeOf($tree), "Tree should contain 2 s-expressions");

    $this->assertEquals(4, $tree[0]->length(), "First s-expressions should be of length 4");
    $this->assertEquals(3, $tree[1]->length(), "Second s-expressions should be of length 3");
  }

}
