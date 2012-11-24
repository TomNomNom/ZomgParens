<?php
namespace Library;

$tf = new \Lisp\TypeFactory();
$translatePHPFn = function($phpFn) use($tf){
  return function() use($phpFn, $tf){
    $args = array_map(function($arg){
      return $arg->value();
    }, func_get_args()); 

    return $tf->makeScalar(
      call_user_func_array($phpFn, $args)
    );
  };
};


// Add
$symbols['+'] = function() use($tf){
  return $tf->makeScalar(
    array_sum(
      array_map(function($item){
        return $item->value();
      }, func_get_args())
    )
  );
};

// Subtract
$symbols['-'] = function(\Lisp\Type\Scalar $a, \Lisp\Type\Scalar $b) use($tf){
  return $tf->makeScalar(
    $a->value() - $b->value()
  );
};

// Multiply
$symbols['*'] = function(\Lisp\Type\Scalar $a, \Lisp\Type\Scalar $b) use($tf){
  return $tf->makeScalar(
    $a->value() * $b->value()
  );
};

// Divide
$symbols['/'] = $symbols['div'] = function(\Lisp\Type\Scalar $a, \Lisp\Type\Scalar $b) use($tf){
  return $tf->makeScalar(
    $a->value() / $b->value()
  );
};

// Translated
$symbols['substr'] = $translatePHPFn('substr');
$symbols['strpos'] = $translatePHPFn('strpos');

return $symbols;
