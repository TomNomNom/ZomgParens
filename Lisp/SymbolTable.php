<?php
namespace Lisp;

class SymbolTable {
  protected $symbols = [];

  public function __construct(Array $symbols = []){
    $this->symbols = $symbols; 
  }

  public function get($key){
    if (!isSet($this->symbols[$key])){
      return null;
    }

    return $this->symbols[$key];
  }

  public function set($key, $value){
    $this->symbols[$key] = $value;
  }
}
