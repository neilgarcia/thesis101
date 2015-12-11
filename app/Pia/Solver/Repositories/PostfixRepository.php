<?php namespace Pia\Repositories;

class PostfixRepository{

  function __construct() {
    $this->output = '';
    $this->temp = '';
    $this->stack = array();
    $this->postfix = array();
    $this->left = array();
    $this->right = array();
    $this->storage = array();
  }



  function postfix($equation)
  {
   unset($this->stack);
   $this->stack = array();
   $this->output = "";
   for ($i=0; $i < strlen($equation); $i++) {
      //123+5*6
     $char = $equation{$i};
     switch ($char) {
       case '+':
       case '-':
       $this->output = $this->output . ',';
       operator($char, 1);
       break;
       case '*':
       case '/':
       $this->output = $this->output . ',';
       operator($char, 2);
       break;
       case '(':
         array_push($this->stack, $char);
         break;
       case ')':
        paren($char);
        break;
      default:
        $this->output = $this->output . $char;
        break;
      }
  }
      $this->output = $this->output . ',';
      while(count($this->stack) > 0){

       $this->output = $this->output . array_pop($this->stack) . ',' ;
      }
      //var_dump($this->output);
      return $this->output;
  }

  function operator($char, $num){
    while(count($this->stack) > 0){
      $op = array_pop($this->stack);
      if($op == '('){
        array_push($this->stack, $op);
        break;
      }else{
        $num2 = 0;
        if($op == '+' || $op == '-')
          $num2 = 1;
        else
          $num2 = 2;
        if($num > $num2){
          array_push($this->stack, $op);
          break;
        }else
          $this->output = $this->output . $op . ',';
      }
    }
    array_push($this->stack, $char);
  }

  function paren($char){
  while(count($this->stack)){
    $ch = array_pop($this->stack);
    if($ch == '(')
      break;
      else
        $this->output = $this->output . "," .$ch;
    }
  }
}
