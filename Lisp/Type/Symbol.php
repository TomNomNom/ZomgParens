<?php
namespace Lisp\Type;

class Symbol extends \Lisp\Type {
  protected $name;

  public function __construct($name){
    $this->name = $name;
  }

  public function name(){
    return $this->name;
  }

  public function evaluate(\Lisp\SymbolTable $symbols = null){
    if (is_null($symbols)) return null;
    return $symbols->get($this->name); 
  }
}
