<?php

  $num1 = "15X";
  $num2 = "-5";
  $pattern = "/^-?[0-9]*$/";
  if(preg_match($pattern, $num2)){
    echo "matched!";
  }else{
    echo "mismatch!";
  }
?>
