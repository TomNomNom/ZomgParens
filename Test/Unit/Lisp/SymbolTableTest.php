<?php
namespace Test\Unit\Lisp;

class SymbolTableTest extends \PHPUnit_Framework_TestCase {
  
  public function testConstructGet(){
    $st = new \Lisp\SymbolTable([
      'testKey' => 'testValue'
    ]);
    $this->assertEquals('testValue', $st->get('testKey'), "Fetched symbol [testKey] should have [testValue]");
  }

  public function testNullGet(){
    $st = new \Lisp\SymbolTable();
    $this->assertNull($st->get('foo'), "Fetched symbol [foo] should have been null");
  }

  public function testSetGet(){
    $st = new \Lisp\SymbolTable();
    $st->set('testKey', 'testValue');
    $this->assertEquals('testValue', $st->get('testKey'), "Fetched symbol [testKey] should have [testValue]");
  }

}
