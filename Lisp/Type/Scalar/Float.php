<?php
namespace Lisp\Type\Scalar;

class Float extends \Lisp\Type\Scalar {
  public function value(){
    return (float) $this->value;
  }
}
