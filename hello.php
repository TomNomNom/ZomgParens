<?php
$test = "
  (echo 1 2 (+ 2 3))
  (echo 'Hello, World!')
  (echo 'They\'re a handful of \ ')
";

echo $test;

function parse(&$chars){

  $sexp = array();
  $token = '';

  while ($char = array_shift($chars)){
    if ($char == '('){
      array_push($sexp, parse($chars));
      continue;
    }
    if ($char == ')'){
      if ($token != ''){
        array_push($sexp, $token);
      }
      break;
    }

    if (isQuote($char)){
      array_push($sexp, readString($char, $chars));
      continue;
    } 

    if (isWhitespace($char)){
      if ($token != ''){
        array_push($sexp, $token);
      }
      $token = '';
      continue;
    }
    
    $token .= $char;
  }

  return $sexp;
}

var_dump(parse(str_split($test)));


function readString($quote, &$chars){
  $string = '';
  $prevChar = null;
  while ($char = array_shift($chars)){
    if ($char == $quote && $prevChar !== '\\'){
      break;
    }
    $string .= $char;
    $prevChar = $char;
  }
  return $string;
}
function isQuote($str){
  return (
    ($str === '"') ||
    ($str === "'") 
  );
}
function isWhitespace($str){
  return (
    ($str === ' ')  ||
    ($str === "\r") ||
    ($str === "\n") ||
    ($str === "\t") 
  );
}
