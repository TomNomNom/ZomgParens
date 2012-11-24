<?php
namespace Lisp\Type\Scalar;

class Integer extends \Lisp\Type\Scalar {
  public function value(){
    return (int) $this->value;
  }
}
