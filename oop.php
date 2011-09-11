<?php
namespace Lisp;

$test = "
  (echo 1 2 (+ 2 3))
  (echo 'Hello, World!')
  (echo 'They\'re a handful of \\\')
";

echo $test;

class Parser {
  protected $rawCode = '';
  protected $chars   = array();
  protected $char    = '';

  const ESCAPE_CHAR     = '\\';
  const SEXP_START_CHAR = '(';
  const SEXP_END_CHAR   = ')';

  public function __construct($rawCode = null){
    if (isset($rawCode)){
      $this->rawCode = $rawCode;
    }
  }

  public function parse($rawCode = null){
    if (isset($rawCode)){
      $this->rawCode = $rawCode;
    }
    $this->chars = str_split($this->rawCode);
    return $this->parseCharArray();
  }

  protected function parseCharArray(){
    $sexp = array();
    $token = '';

    while ($this->incrementPointer()){

      if ($this->charIsSexpStart()){
        // Recurse
        array_push($sexp, $this->parseCharArray());
        continue;
      }

      if ($this->charIsSexpEnd()){
        if ($token != ''){
          array_push($sexp, $token);
        }
        break;
      }

      if ($this->charIsQuote()){
        array_push($sexp, $this->readString($this->char));
        continue;
      } 

      if ($this->charIsWhitespace()){
        if ($token != ''){
          array_push($sexp, $token);
        }
        $token = '';
        continue;
      }
      
      $token .= $this->char;
    }

    return $sexp;
  }

  protected function readString($quote){
    $string = '';
    $inEscapeSequence = false;

    // Warning: heavy-ish commenting follows as I kept getting this wrong
    while ($this->incrementPointer()){

      // If we're not in an ES already and the char is \, switch to being in an ES
      if (!$inEscapeSequence && $this->charIsEscapeChar()){
        $inEscapeSequence = true;
        continue;
      }

      // If we're in an ES and the char is not escapable, we need to put the 
      // \ back and revert to not being in an ES
      if ($inEscapeSequence && !$this->charIsEscapable()){
        $string .= static::ESCAPE_CHAR;
        $inEscapeSequence = false;
      }

      // If we're not in an ES and we've hit a quote matching the starting one
      // then we're at the end of the string and need to return
      if (!$inEscapeSequence && $this->getChar() === $quote){
        break;
      }

      // If we've reached this point then we're definitely not in an ES anymore
      $inEscapeSequence = false;

      // If we got this far it's safe to just append the char 
      $string .= $this->getChar();
    }
    return $string;
  }

  protected function incrementPointer(){
    return $this->char = next($this->chars);
  }

  protected function getChar(){
    return $this->char; 
  }

  protected function charIsSexpStart(){
    return ($this->char === static::SEXP_START_CHAR);
  }

  protected function charIsSexpEnd(){
    return ($this->char === static::SEXP_END_CHAR);
  }

  protected function charIsEscapeChar(){
    return ($this->char === static::ESCAPE_CHAR);
  }

  protected function charIsEscapable(){
    return (
      $this->charIsQuote() ||
      ($this->char === static::ESCAPE_CHAR)
    );
  }

  protected function charIsQuote(){
    return in_array($this->char, array(
      '"', "'"
    ));
  }
  protected function charIsWhitespace(){
    return in_array($this->char, array(
      " ", "\r", "\n", "\t"
    ));
  }
}


$parser = new Parser($test);
var_dump($parser->parse());


