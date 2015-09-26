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
        $GLOBALS['output'] = $GLOBALS['output'] . $ch;
    }
  }

  function analyze($expr, $side)
  {
    $e = explode(',', $expr);
    array_pop($e); //removes the last comma
    $num_pattern = "/^-?[0-9]*$/";

    $operators = array('+', '-', '*', '/');
    $result = 0;
    for ($i=0; $i < count($e); $i++) {
      if(in_array($e[$i], $operators)){
        $num1 = array_pop($GLOBALS[$side]);
        $num2 = array_pop($GLOBALS[$side]);
        if(preg_match($var_pattern, $num1) AND preg_match($var_pattern, $num2)){
          $result = calculate($num1, $num2, $e[$i]);
          array_push($GLOBALS[$side], $result . "x");
        }elseif(preg_match($num_pattern, $num1) AND preg_match($num_pattern, $num2)){
          $result = calculate($num1, $num2, $e[$i]);
          array_push($GLOBALS[$side], $result);
        }else{
          if(preg_match($var_pattern, $num1)){

            if($side == 'left'){
              array_push($GLOBALS[$side], $num1);
            }else{
              $temp = array_pop($GLOBALS['left']);
              $result = transpose($temp, $num1, $e[$i]);
              array_push($GLOBALS['left'], $result . "x");
            }
          }elseif(preg_match($num_pattern, $num1)){
            //echo "<BR>num1: " , $num1 , "matched num pattern at side $side!<br>";
            if($side == 'right'){
              array_push($GLOBALS[$side], $num1);
            }else{
              if($e[$i] == '+'){
                array_push($GLOBALS['storage'], "-" . $num1);
              }
              else{
                array_push($GLOBALS['storage'], $num1);
              }
            }
          }
          if(preg_match($var_pattern, $num2)){
            if($side == 'left'){
              array_push($GLOBALS[$side], $num2);
            }else{
              array_push($GLOBALS['left'], array_pop($GLOBALS['left'])-$num2 . "x");
            }
          }elseif(preg_match($num_pattern, $num2)){
            //echo "<BR>num2: " , $num2 , "matched num pattern at side $side!<br>";
            if($side == 'right'){
              array_push($GLOBALS[$side], $num2);
            }else{
              if($e[$i] == '+'){
                array_push($GLOBALS['storage'], "-" . $num2);
              }
              else{
                array_push($GLOBALS['storage'], $num2);
              }
            }
          }
        }

      }else{
        array_push($GLOBALS[$side], $e[$i]);
      }
    }

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
    $eq = explode(",", $expr['left']);
    array_pop($eq);

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
    $eq = explode(",", $expr['right']);
    array_pop($eq);

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
    var_dump($stack);
    return $expr;
  }

  // for ($i=0; $i < count($expr); $i++) {
  //   if($i == 0){
  //     $side = 'left';
  //   }else{
  //     $side = 'right';
  //   }
  //   $eq = postfix($expr[$i], $side);
  //   $result = firststep($eq); // transfer all numbers from left to right

  //   analyze($eq, $side);
  // }
    $eq['left'] = postfix($expr[0]);
    $eq['right'] = postfix($expr[1]);
    $eq = firststep($eq);
    var_dump($eq);
    // while(count($GLOBALS['storage']) > 0){
    //   $num1 = array_pop($GLOBALS['right']);
    //   $num2 = array_pop($GLOBALS['storage']);
    //   $result = $num1 + $num2;
    //   array_push($GLOBALS['right'], $result);
    // }
    // echo "<pre>";
    // var_dump($GLOBALS['left']);
    // var_dump($GLOBALS['right']);
    // echo "</pre>";


  ?>
