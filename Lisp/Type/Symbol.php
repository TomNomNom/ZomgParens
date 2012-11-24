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
}
