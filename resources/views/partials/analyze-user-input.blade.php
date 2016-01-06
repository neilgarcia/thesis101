<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
  .a-step, .a-final{
    display: block;
    font-size: 22px;
    margin-top: 21px;

}

.input{
    font-size: 24px;
    width: 85%;
}

.given{
    margin-top: 25px;
}
  </style>
</head>
<body>

</body>
</html>

<?php

$GLOBALS['output'] = "";
$GLOBALS['stack'] = array();
$GLOBALS['temp'] = "";
$GLOBALS['postfix'] = array();
$GLOBALS['left'] = array();
$GLOBALS['right'] = array();
$GLOBALS['storage'] = array();
$equation = str_replace('|', '/', $equation);
$equation = str_replace(' ', '', $equation);
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
  $var_pattern = "/[0-9]+(\.[0-9][0-9]?)?[xX]$/";

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
    if(count($stack) == 1)
      return array_pop($stack);
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
          $expr['right'] = trim($expr['right'], ",") . "," . $eq[$i] . ",-,";
          $i++;
        }elseif($eq[$i+1] == '-'){
          $expr['right'] = trim($expr['right'], ",") . "," . $eq[$i] . ",+,";
          $i++;
        }else{
          $expr['right'] = trim($expr['right'], ",") . "," . $eq[$i] . ",-,";
          $stack .= "0x,";
        }

      }else{
        $stack .= $eq[$i] . ",";
      }

    }
    $expr['left'] = $stack;
    $stack = "";
    $eq = exp_to_array($expr['right']);

    for ($i=0; $i < count($eq); $i++) {
      if(is_variable($eq[$i]) && $i < count($eq)-1){
        if($eq[$i+1] == '+'){
          $expr['left'] = trim($expr['left'], ",") . "," . $eq[$i] . ",-,";
          $i++;
        }elseif($eq[$i+1] == '-'){
          $expr['left'] = trim($expr['left'], ",") . "," . $eq[$i] . ",+,";
          $i++;
        }else{
          $expr['left'] = trim($expr['left'], ",") . "," . $eq[$i] . ",-,";
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

  function gcd($num1, $num2){
    $a = abs($num1);
    $b = abs($num2);
    return ($b == 0) ? $a : gcd($b, $a%$b);
  }

  function simplify($var, $num)
  {

    $result = 0;
    $var = str_replace('x', '', $var);

    if(fmod($num ,$var) == 0){
      $result = $num / $var;
    }else{
      $gcd = gcd($num, $var);
      $num /= $gcd;
      $var /= $gcd;
      $result = "$num/$var or " . round($num/$var, 2);
    }
    return $result;
  }


  function normalize($e)
  {
  $result = array();
  foreach ($e as $expression) {
    for ($i=0; $i < strlen($expression); $i++) {
    if($expression{$i} == '(' && $i != 0 && is_numeric($expression{$i-1})){
      $expression = substr_replace($expression, '*', $i, 0);
    }
    if($i > 0 && $expression{$i} == "x" && !is_numeric($expression{$i-1})){
      $expression = substr_replace($expression, '1', $i, 0);
    }
    }
    array_push($result, $expression);
  }

  return $result;

  }

  function exp_to_array($expr)
  {
    $e = explode(",", $expr);
    if(count($e) > 1)
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

    $ctr = 1;
    $result = array();
    foreach ($expr as $expression) {
      $e = exp_to_array($expression);
      $stack = array();
      $temp = array();

      for ($i=0; $i < count($e); $i++) {
        if(is_operator($e[$i])){
          $op = $e[$i];
          $num2 = array_pop($stack);

          $num1 = array_pop($stack);

          switch($op){
            case '+':
            case '-':
              $temp = trim($num1, ",") . "," . trim($num2, ",") .",". $op. ",";
              array_push($stack, $temp);
              break;
            case '*':
              $multiplier = 0;
              $storage = array();
              $temp = array();

              if(is_numeric($num1) || is_variable($num1)){
                $multiplier = $num1;
                $temp = explode(",", $num2);
              }else{
                $multiplier = $num2;
                $temp = explode(",", $num1);
              }
              if(count($temp) > 1)
                array_pop($temp);
              foreach ($temp as $ex) {

                if(is_numeric($ex) && !is_variable($multiplier)){

                  array_push($storage, $ex * $multiplier);

                }elseif(is_variable($ex) || is_variable($multiplier)){
                  array_push($storage, $ex * $multiplier . "x");
                }else{
                  array_push($storage, $ex);
                }
              }

              $temp = "";
              foreach($storage as $ex) {
                $temp .= $ex . ",";
              }

              array_push($stack, $temp);

              echo "<br>";
              break;
          }
        }else{
          array_push($stack, $e[$i]);
        }
      }
      if($ctr == 1)
        $result['left'] = array_pop($stack);
      else
        $result['right'] = array_pop($stack);
      $ctr++;
    }
    return $result;
  }

  $distribute = false;
  $leftToright = false;
    foreach ($expr as $expression) {
      $paren = strpos($expression, "(");
      if($paren !== false && $paren > 0 && is_numeric($expression{$paren-1})){
        $distribute = true;
        echo "Distribute " , $expression{$paren-1};
      }
    }
    $e = explode(',', postfix($expr[0]));
    for ($i=0; $i < count($e); $i++) {
      if(is_numeric($e[$i])){
        $leftToright = true;
      }
    }

    if(!$distribute){
      echo "nothing to distribute";
    }

    $arr = array("distribute"=>$distribute);

    // echo json_encode($arr);
    //$expr = normalize($expr);
     // var_dump($expr);
    // $eq['left'] = postfix($expr[0]);
    // //echo $eq['left'] . "<br>";

    // $eq['right'] = postfix($expr[1]);
    // //echo $eq['right'] . "<br>";

    // $eq = distribute($eq);

    // //var_dump($eq);



    // echo "<h1 class='given'>GIVEN: $equation</h1>";
    // echo "<span class='a-step'>Distribute: " . infix($eq['left']) . " = " . infix($eq['right']) . "</span>";
    // //     var_dump($eq);
    // //     var_dump($eq['right']);

    //  $eq = firststep($eq);
    //  //var_dump($eq);

    // echo "<span class='a-step'>First Step: " . infix($eq['left']) . "=" . infix($eq['right']) . "</span>";
    //  //var_dump($eq['right']);
    //  $eq['left'] = analyze($eq['left'], 'left');

    //  $eq['right'] = analyze($eq['right'], 'right');

    // $eq['left'] = array_pop($eq['left']);
    // $eq['right'] = array_pop($eq['right']);

    // echo "<span class='a-step'>Second Step: " . $eq['left'] . "=" . $eq['right'] . "</span>";
    // //var_dump($eq);
    // $result = simplify($eq['left'], $eq['right']);

    // echo "<span class='a-step'>Third Step: x = $result </span>";





  ?>
