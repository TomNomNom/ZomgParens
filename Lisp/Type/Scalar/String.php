<?php
namespace Lisp\Type\Scalar;

class String extends \Lisp\Type\Scalar {
  public function value(){
    return (string) $this->value;
  }
}
