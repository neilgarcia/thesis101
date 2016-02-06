
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
$given = str_replace('|', '/', $given);
$given = str_replace(' ', '', $given);
$expr = explode('=', $equation);
$given = explode('=', $given);

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
     if($i == 0){
      $GLOBALS['output'] = $char . $GLOBALS['output'];
      break;
     }
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

    if(substr($GLOBALS['output'], -1) == ","){
      $GLOBALS['output'] = rtrim($GLOBALS['output'],',');

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
    if(end($stack) == "")
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
    if(substr($stack, -1) == ","){
      $stack = rtrim($stack, ',');
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

    if(substr($stack, -1) == ","){
      $stack = rtrim($stack, ',');
    }
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
      if($num%$var == 0){
        $result = $num/$var;
      }else{
        $result = "$num/$var";
      }

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
    if(end($e) == "")
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
            case '/':
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


              break;
          }
        }else{
          array_push($stack, $e[$i]);
        }
      }
      if($ctr == 1){
        $result['left'] = array_pop($stack);
        if(substr($result['left'], -1) == ",")
          $result['left'] = rtrim($result['left'], ',');
      }
      else{
        $result['right'] = array_pop($stack);
        if(substr($result['right'], -1) == ",")
        $result['right'] = rtrim($result['right'], ',');
    }
      $ctr++;
    }
    return $result;
  }

  function lowestTerm($e)
  {
    $part = explode('/', $e);
    $gcd = gcd($part[0], $part[1]);
    return $gcd;
  }

    function check($expr, $given)
    {
      $eq['left'] = postfix($expr[0]);
      $eq['right'] = postfix($expr[1]);
      $eq = distribute($eq);
      $eq = firststep($eq);

      $eq['left'] = analyze($eq['left'], 'left');
      $eq['right'] = analyze($eq['right'], 'right');
      $eq['left'] = array_pop($eq['left']);
      $eq['right'] = array_pop($eq['right']);
      if($eq['left'] == "x")
        $resultExpr = $eq['right'] / 1;
      else
        $resultExpr = $eq['right'] / $eq['left'];

      $eq['left'] = postfix($given[0]);

      $eq['right'] = postfix($given[1]);
      $eq = distribute($eq);
      $eq = firststep($eq);
      $eq['left'] = analyze($eq['left'], 'left');
      $eq['right'] = analyze($eq['right'], 'right');
      $eq['left'] = array_pop($eq['left']);
      $eq['right'] = array_pop($eq['right']);
      if($eq['left'] == "x")
        $resultGiven = $eq['right'] / 1;
      else
        $resultGiven = $eq['right'] / $eq['left'];

      if($resultGiven == $resultExpr){
        return true;
      }
      return false;
    }

    $expr = normalize($expr);
    $given = normalize($given);

     if($method == 'auto'){

        $eq['left'] = postfix($expr[0]);
        $eq['right'] = postfix($expr[1]);
        $eq = distribute($eq);
        echo "<h1 class='given'>GIVEN: $equation</h1>";
        echo "<span class='a-step'>Distribute: " . infix($eq['left']) . " = " . infix($eq['right']) . "</span>";
        $eq = firststep($eq);
        echo "<span class='a-step'>First Step: " . infix($eq['left']) . "=" . infix($eq['right']) . "</span>";
        $eq['left'] = analyze($eq['left'], 'left');
        $eq['right'] = analyze($eq['right'], 'right');
        $eq['left'] = array_pop($eq['left']);
        $eq['right'] = array_pop($eq['right']);
        echo "<span class='a-step'>Second Step: " . $eq['left'] . "=" . $eq['right'] . "</span>";
        $result = simplify($eq['left'], $eq['right']);
        echo "<span class='a-step'>Third Step: x = $result </span>";

     }else if($method == 'hint'){

      $eq['left'] = postfix($expr[0]);
      $eq['right'] = postfix($expr[1]);
      $distribute = distribute($eq);
      // var_dump($distribute);
      // var_dump($eq);
      if($distribute <> $eq){
        $result = infix($distribute['left']) . " = " . infix($distribute['right']);
        echo json_encode(array('result'=>$result, 'finalAnswer'=>false));
      }
      $firststep = firststep($distribute);
      // var_dump($firststep);
      // var_dump($distribute);
      if($firststep <> $distribute){
        $result = infix($firststep['left']) . " = " . infix($firststep['right']);
        echo json_encode(array('result'=>$result, 'finalAnswer'=>false));
      }

      $eq['left'] = analyze($firststep['left'], 'left');
      $eq['right'] = analyze($firststep['right'], 'right');
      $eq['left'] = array_pop($eq['left']);
      $eq['right'] = array_pop($eq['right']);
      // var_dump($eq);
      // var_dump($firststep);
      if($eq <> $firststep){

        $result = $eq['left'] . "=" . $eq['right'];
        echo json_encode(array('result'=>$result, 'finalAnswer'=>false));
      }

      $result = simplify($eq['left'], $eq['right']);

      if($result <> $eq['right']){
        $answer = "x = " . $result;
        $data = array('result'=>$answer, 'finalAnswer'=>true);
        echo json_encode($data);
      }



     }else{

        $ctr = 0;
        $equationSteps = 0;
        $givenSteps = 0;
        $lowestTerm = false;
        $equations = array($given, $expr);
        foreach ($equations as $expr) {
          $distribute = array();
        $leftToRight = array();
        $rightToLeft = array();
        $simplifyLeft = false;
        $simplifyRight = false;
        $finalize = array();
        $finalAnswer = false;
        $data['error'] = false;
        $ctr++;
      if($given[0] <> "none"){
        $checkIfEqual = check($expr, $given);
      }
      else{
        $checkIfEqual = true;
        break;
      }
      if(!$checkIfEqual){
        $data['error'] = true;
        $expr = $given;
      }

          foreach ($expr as $expression) {
            $num = "";
            for ($i=0; $i < strlen($expression)-2; $i++) {

              if(is_numeric($expression{$i})){
                  //echo $expression{$i};
                  $num = $num . $expression{$i};
              }elseif($expression{$i} == "*" && $expression{$i+1} == "("){
                array_push($distribute, $num);
                $num = "";
              }else{
                $num = "";
              }
            }

          }

          $left = postfix($expr[0]);
          $left = explode(",", $left);

          foreach ($left as $part) {
            if(is_numeric($part)){
              array_push($leftToRight, $part);
            }
          }

          $right = postfix($expr[1]);
          $right = explode(",", $right);

          foreach ($right as $part) {
            if(is_variable($part)){
              array_push($rightToLeft, $part);
            }
          }

          if(count($leftToRight) == 0 && count($rightToLeft) == 0){

            if(count($left) > 2){
              $simplifyLeft = true;
            }elseif(count($right)>2){
              $clone = $right;
              // array_pop($right);

              $op = array_pop($right);
              if($op == "/"){
                $num2 = array_pop($right);
                $num1 = array_pop($right);
                if(fmod($num1, $num2) == 0){
                  $simplifyRight = true;

                }
                else{
                  // array_pop($left);
                  $right = $num1 . "/" . $num2;
                  array_push($finalize, array_pop($left));
                  array_push($finalize, $right);
                  if($finalize[0] == "1x" || $finalize[0] == "x"){

                    if(lowestTerm($finalize[1]) > 1){

                      $lowestTerm = true;
                      $simplifyRight = true;
                    }
                    else{
                      $finalAnswer = true;

                    }
                  }

                }
              }else{
                $simplifyRight = true;
              }

            }else{
              // array_pop($left);
              // array_pop($right);
              array_push($finalize, array_pop($left));
              array_push($finalize, array_pop($right));
              if($finalize[0] == "1x" || $finalize[0] == "x")
                  $finalAnswer = true;

              //$finalize = array_push(array_pop($right));
            }

          }

          if($distribute){
            if($ctr == 1){
              $givenSteps = 1;
            }else{
              $equationSteps = 1;
            }
          }else if($leftToRight){
            if($ctr == 1){
              $givenSteps = 2;
            }else{
              $equationSteps = 2;
            }
          }else if($rightToLeft){
            if($ctr == 1){
              $givenSteps = 3;
            }else{
              $equationSteps = 3;
            }
          }else if($simplifyLeft){
            if($ctr == 1){
              $givenSteps = 4;
            }else{
              $equationSteps = 4;
            }
          }else if($lowestTerm){
            if($ctr == 1){
              $givenSteps = 6;
            }else{
              $equationSteps = 6;
            }

          }else if($simplifyRight){
            if($ctr == 1){
              $givenSteps = 5;
            }else{
              $equationSteps = 5;
            }
          }else if($finalAnswer){
            if($ctr == 1){
              $givenSteps = 6;
            }else{
              $equationSteps = 6;
            }
          }else if($finalize){
            if($ctr == 1){
              $givenSteps = 5;
            }else{
              $equationSteps = 5;
            }
          }

        }


          if($equationSteps < $givenSteps){

            $data['error'] = true;
          }
          $data['distribute'] = $distribute;
          $data['left'] = $leftToRight;
          $data['right'] = $rightToLeft;
          $data['simplifyleft'] = $simplifyLeft;
          $data['simplifyright'] = $simplifyRight;
          $data['finalize'] = $finalize;
          $data['finalAnswer'] = $finalAnswer;
          echo json_encode($data);

     }




  ?>
