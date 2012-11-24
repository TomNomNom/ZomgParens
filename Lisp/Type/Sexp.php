<?php
namespace Lisp\Type;

class Sexp extends \Lisp\Type {
  protected $items = [];

  public function __construct(){
     
  }

  public function push(\Lisp\Type $item){
    $this->items[] = $item;
  }

  public function item($index){
    if (!isset($this->items[$index])){
      return null;
    }
    return $this->items[$index];
  }

  public function length(){
    return sizeOf($this->items);
  }
}
