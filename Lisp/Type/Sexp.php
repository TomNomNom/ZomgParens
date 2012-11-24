<?php
namespace Lisp\Type;

class Sexp extends \Lisp\Type {
  protected $items = [];

  public function __construct(Array $items = []){
    $this->items = $items; 
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

  protected function fnSymbol(){
    return $this->item(0);
  }

  protected function args(){
    return array_slice($this->items, 1); 
  }

  public function evaluate(\Lisp\SymbolTable $symbols = null){
    if (is_null($symbols)) return null;

    $fnSymbol = $this->fnSymbol();
    $fn = $fnSymbol->evaluate($symbols);

    if (!is_callable($fn)){
      throw new \Lisp\Exception("[{$fnSymbol}] is not callable");
    }

    $args = array_map(function($arg) use($symbols){
      if ($arg instanceof \Lisp\Type\Sexp){
        return $arg->evaluate($symbols);
      }
      if ($arg instanceof \Lisp\Type\Symbol){
        return $arg->evaluate($symbols);
      }
      return $arg;
    }, $this->args());

    $result = call_user_func_array($fn, $args);

    $tf = new \Lisp\TypeFactory();
    return $tf->makeScalar($result);
  }

}
