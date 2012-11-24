<?php
namespace Lisp;

class TypeFactory {
  public function make($raw){
    if ($raw instanceof \Lisp\Type){
      return $raw;
    }
    if (is_array($raw)){
      return $this->makeSexp($raw);
    }
    if (is_numeric($raw)){
      return $this->makeScalar($raw);
    }
    return $this->makeSymbol($raw);
  }

  public function makeScalar($raw){
    if ($raw instanceof \Lisp\Type){
      return $raw;
    }
    if (is_numeric($raw)){
      if (strpos($raw, '.') !== false){
        return $this->makeFloat($raw);
      }
      return $this->makeInteger($raw);
    }
    return $this->makeString($raw);
  }

  public function makeString($raw){
    return new Type\Scalar\String($raw);
  }

  public function makeInteger($raw){
    return new Type\Scalar\Integer($raw);
  }

  public function makeFloat($raw){
    return new Type\Scalar\Float($raw);
  }

  public function makeSymbol($raw){
    return new Type\Symbol($raw);
  }

  public function makeSexp(Array $items = []){
    return new Type\Sexp($items);
  }
}
