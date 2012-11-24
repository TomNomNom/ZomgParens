<?php
namespace Lisp\Type;

abstract class Scalar extends \Lisp\Type {
  protected $value;

  public function __construct($value){
    $this->value = $value;
  }

  public function value(){
    return $this->value;
  }
}
