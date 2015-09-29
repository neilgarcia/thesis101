<?php

  $num1 = "5(3x+2)";
  $num2 = "5(3x+2)+3(2x+1)+4(3x+1)";

  for ($i=0; $i < strlen($num2); $i++) {
    if($num2{$i} == '(' && is_numeric($num2{$i-1})){
      $num2 = substr_replace($num2, '*', $i, 0);

    }
  }

  echo $num2;
?>
