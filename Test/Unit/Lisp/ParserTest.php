<?php
namespace Test\Unit\Lisp;

class ParserTest extends \PHPUnit_Framework_TestCase {
  
  public function testBasic(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump 1 2 3)';
    $expected = array(
      array('var_dump', '1', '2', '3')
    );
    $this->assertEquals($expected, $parser->parse($code));
  }

  public function testStringEscapes(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump "I said \"Hello!\"")';
    $expected = array(
      array('var_dump', 'I said "Hello!"')
    );
    $this->assertEquals($expected, $parser->parse($code));

    $code = "(var_dump 'I said \'Hello!\'')";
    $expected = array(
      array('var_dump', "I said 'Hello!'")
    );
    $this->assertEquals($expected, $parser->parse($code));
  }

  public function testNesting(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump "Hello" (ucfirst "tom"))';
    $expected = array(
      array(
        'var_dump', 
        'Hello', 
        array(
          'ucfirst', 
          'tom'
        )
      )
    );
    $this->assertEquals($expected, $parser->parse($code));
  }

  public function testMultipleSexps(){
    $parser = new \Lisp\Parser();

    $code = '(var_dump 1 2 3)(var_dump 4 5 6)';
    $expected = array( 
      array('var_dump', '1', '2', '3'),
      array('var_dump', '4', '5', '6')
    );
    $this->assertEquals($expected, $parser->parse($code));
  }

  public function testWhitespaceIntolerant(){
    $parser = new \Lisp\Parser();

    $code = '
      (var_dump 1 
                2 
                3)
      (var_dump 4 5 6)
    ';
    $expected = array( 
      array('var_dump', '1', '2', '3'),
      array('var_dump', '4', '5', '6')
    );
    $this->assertEquals($expected, $parser->parse($code));
  }

}
