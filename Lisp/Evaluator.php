<?php
namespace Lisp;

class Evaluator {
  protected $tree    = [];
  protected $symbols = [];

  protected $lastReturnValue = null;

  public function __construct(Array $tree, \Lisp\SymbolTable $symbols){
    $this->tree    = $tree;
    $this->symbols = $symbols;
  }

  public function evaluate(){
    foreach ($this->tree as $sexp){
      $this->lastReturnValue = $sexp->evaluate($this->symbols);
    }
  }

  public function lastReturnValue(){
    return $this->lastReturnValue;
  }
}
