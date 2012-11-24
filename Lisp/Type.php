<?php
namespace Lisp;

abstract class Type {
  abstract public function evaluate(\Lisp\SymbolTable $symbols = null);
}
