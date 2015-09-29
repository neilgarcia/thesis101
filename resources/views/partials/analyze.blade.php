<?php

$GLOBALS['output'] = "";
$GLOBALS['stack'] = array();
$GLOBALS['temp'] = "";
$GLOBALS['postfix'] = array();
$GLOBALS['left'] = array();
$GLOBALS['right'] = array();
$GLOBALS['storage'] = array();
$equation = str_replace('|', '/', $equation);
$expr = explode('=', $equation);

function postfix($equation)
{
 unset($GLOBALS['stack']);
 $GLOBALS['stack'] = array();
 $GLOBALS['output'] = "";
 for ($i=0; $i < strlen($equation); $i++) {
    //123+5*6
   $char = $equation{$i};
   switch ($char) {
     case '+':
     case '-':
     $GLOBALS['output'] = $GLOBALS['output'] . ',';
     operator($char, 1);
     break;
     case '*':
     case '/':
     $GLOBALS['output'] = $GLOBALS['output'] . ',';
     operator($char, 2);
     break;
     case '(':
       array_push($GLOBALS['stack'], $char);
       break;
     case ')':
      paren($char);
      break;
    default:
      $GLOBALS['output'] = $GLOBALS['output'] . $char;
      break;
}
}
    $GLOBALS['output'] = $GLOBALS['output'] . ',';
    while(count($GLOBALS['stack']) > 0){

     $GLOBALS['output'] = $GLOBALS['output'] . array_pop($GLOBALS['stack']) . ',' ;
    }
    //var_dump($GLOBALS['output']);
    return $GLOBALS['output'];
}

function operator($char, $num){
  while(count($GLOBALS['stack']) > 0){
    $op = array_pop($GLOBALS['stack']);
    if($op == '('){
      array_push($GLOBALS['stack'], $op);
      break;
    }else{
      $num2 = 0;
      if($op == '+' || $op == '-')
        $num2 = 1;
      else
        $num2 = 2;
      if($num > $num2){
        array_push($GLOBALS['stack'], $op);
        break;
      }else
        $GLOBALS['output'] = $GLOBALS['output'] . $op . ',';
    }
  }
  array_push($GLOBALS['stack'], $char);
}
function is_variable($e){
  $var_pattern = "/^[0-9]*[xX]$/";
  if(preg_match($var_pattern, $e)){
    return true;
  }
  return false;
}
function paren($char){
  while(count($GLOBALS['stack'])){
    $ch = array_pop($GLOBALS['stack']);
    if($ch == '(')
      break;
      else
        $GLOBALS['output'] = $GLOBALS['output'] . "," .$ch;
    }
  }

  function analyze($expr, $side)
  {
    $e = exp_to_array($expr);

    $operators = array('+', '-', '*', '/');
    $result = 0;
    for ($i=0; $i < count($e); $i++) {
      if(in_array($e[$i], $operators)){
        $num1 = array_pop($GLOBALS[$side]);
        $num2 = array_pop($GLOBALS[$side]);
        if(is_variable($num1) AND is_variable($num2)){
          $result = calculate($num1, $num2, $e[$i]);
          array_push($GLOBALS[$side], $result . "x");
        }elseif(is_numeric($num1) AND is_numeric($num2)){
          $result = calculate($num1, $num2, $e[$i]);
          array_push($GLOBALS[$side], $result);
        }
      }else{
        array_push($GLOBALS[$side], $e[$i]);
      }
    }

    return $GLOBALS[$side];
  }

  function transpose($temp, $num, $operator){
    switch($operator){
      case '+':
        $result = $temp - $num;
        break;
      case '-':
        $result = $temp + $num;
        break;
      case '*':
        $result = $temp / $num;
        break;
      case '/':
        $result = $temp * $num;
        break;
    }
    return $result;
  }
  {
    # code...
  }

  function calculate($num1, $num2, $operator){
    switch($operator){
      case '+':
        $result = $num1 + $num2;
        break;
      case '-':
        $result = $num2 - $num1;
        break;
      case '*':
        $result = $num1 * $num2;
        break;
      case '/':
        $result = $num2 / $num1;
        break;
    }
    return $result;
  }
  //5x+3 = 3x+5

  function infix($expr){
    $stack = explode(",", $expr);
    $e = array();
    if(count($stack) > 0)
    array_pop($stack);
    $op = array('+', '-', '*', '/');
    for ($i=0; $i < count($stack); $i++) {
      if(in_array($stack[$i], $op)){
        $num2 = array_pop($e);
        $num1 = array_pop($e);
        $eq =  $num1 . $stack[$i] . $num2 ;
        array_push($e, $eq);
      }else{
        array_push($e, $stack[$i]);
      }
    }
    $result = array_pop($e);
    return $result;
  }

  function firststep($expr){
    //var_dump($expr);
    $var_pattern = "/^[0-9]*[xX]$/";
    $op = array('+', '-', '*', '/');
    $temp = array();
    $stack = "";
    //echo $expr['left'];
    $eq = exp_to_array($expr['left']);

    for ($i=0; $i < count($eq); $i++) {
      if(is_numeric($eq[$i])){
        if($eq[$i+1] == '+'){
          $expr['right'] .= $eq[$i] . ",-,";
          $i++;
        }elseif($eq[$i+1] == '-'){
          $expr['right'] .= $eq[$i] . ",+,";
          $i++;
        }else{
          $expr['right'] .= $eq[$i] . ",-,";
          $stack .= "0,";
        }

      }else{
        $stack .= $eq[$i] . ",";
      }

    }
    $expr['left'] = $stack;
    $stack = "";
    $eq = exp_to_array($expr['right']);

    for ($i=0; $i < count($eq); $i++) {
      if(is_variable($eq[$i])){
        if($eq[$i+1] == '+'){
          $expr['left'] .= $eq[$i] . ",-,";
          $i++;
        }elseif($eq[$i+1] == '-'){
          $expr['left'] .= $eq[$i] . ",+,";
          $i++;
        }else{
          $expr['left'] .= $eq[$i] . ",-,";
          $stack .= "0,";
        }
      }else{
        $stack .= $eq[$i] . ",";
      }
    }
    //var_dump($stack);
    $expr['right'] = $stack;
    return $expr;
  }

  function simplify($var, $num)
  {
    $var = str_replace('x', '', $var);
    if($num%$var == 0){
      $result = $num / $var;
    }else{
      $result = $num . "/" . $var;
    }
    return $result;
  }


  function normalize($e)
  {
  $result = array();
  foreach ($e as $expression) {
    for ($i=0; $i < strlen($expression); $i++) {
    if($expression{$i} == '(' && is_numeric($expression{$i-1})){
      $expression = substr_replace($expression, '*', $i, 0);

    }
    }
    array_push($result, $expression);
  }

  return $result;

  }

  function exp_to_array($expr)
  {
    $e = explode(",", $expr);
    array_pop($e);
    return $e;
  }

  function is_operator($char)
  {
    $op = array('+', '-', '*', '/');
    if(in_array($char, $op)){
      return true;
    }
    return false;
  }
  function distribute($expr)
  {
    foreach ($expr as $expression) {
      $e = exp_to_array($expression);
      $stack = array();
      $temp = array();
      for ($i=0; $i < count($e); $i++) {
        if(is_operator($e[$i])){
          if($e[$i] == '*'){

          }else{

          }
        }else{
          array_push($stack, $e[$i]);
        }
      }
    }
    return 0;
  }

    $expr = normalize($expr);
    // var_dump($expr);
    $eq['left'] = postfix($expr[0]);
    $eq['right'] = postfix($expr[1]);

    $eq = distribute($eq);

    var_dump($eq);



    // echo "GIVEN: $equation<br>";
    // echo "<pre>";
    // echo "Evalute: " . infix($eq['left']) . " = " . infix($eq['right']) . "<Br>";
    // //var_dump($eq);
    // $eq = firststep($eq);


    // echo "First Step: " . infix($eq['left']) . "=" . infix($eq['right']) . " //move all variables to left and all numbers to right.";

    // $eq['left'] = analyze($eq['left'], 'left');
    // $eq['right'] = analyze($eq['right'], 'right');

    // $eq['left'] = array_pop($eq['left']);
    // $eq['right'] = array_pop($eq['right']);
    // echo "<br>Second Step: " . $eq['left'] . "=" . $eq['right'] . " //Perform the necessary operations";

    // $result = simplify($eq['left'], $eq['right']);

    // echo "<br>Third Step: x = $result //Simplify";

    // echo "</pre>";



  ?>
