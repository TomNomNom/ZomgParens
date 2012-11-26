<?php
namespace Library;

$tf = new \Lisp\TypeFactory();

// Add
$symbols['+'] = function(){
  return array_sum(func_get_args());
};

// Subtract
$symbols['-'] = function($a, $b){
  return $a - $b;
};

// Multiply
$symbols['*'] = function($a, $b){
  return $a * $b;
};

// Divide
$symbols['/'] = $symbols['div'] = function($a, $b){
  return $a / $b;
};

// From PHP
$symbols['strpos'] = 'strpos';

return $symbols;
