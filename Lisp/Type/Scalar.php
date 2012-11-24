<?php
namespace Lisp\Type;

abstract class Scalar extends \Lisp\Type {
  protected $value;

  public function __construct($value){
    $this->value = $value;
  }
  
  abstract public function value();
  
  public function evaluate(\Lisp\SymbolTable $symbols = null){
    return $this->value();
  }
}
