<?php namespace  Pia\Solver;

  use Auth;

  class EquationSolver{

    function __construct(PostfixRepository $repo) {
      $this->repo = $repo;
    }

  }

?>
