<?php

  function is_variable($e){
  $var_pattern = "/[0-9]+(\.[0-9][0-9]?)?[xX]$/";
  if($e == 0)
    return true;
  if(preg_match($var_pattern, $e)){
    return true;
  }
  return false;
}

  $num2 = ".25x";
  var_dump(is_variable($num2));
?>
