<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/register-style.css">
  <script src="/js/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</head>
<body>
  @include('layouts.header');


    <div class="main-content">
    <div class="module-type">
        <h1>
          <strong>P I A</strong>
          <br>
          An intelligent tutoring system built for students learning linear equation.
        </h1>
        <h2>Please choose a module for PIA</h2>
        <a href="/pia/method/auto" id="moduleA" class="btn option">User Given Equation-Auto</a>
        <a href="#" id="moduleB" class="btn option">User Given Equation-Manual</a>
        <a href="/pia" id="moduleC" class="btn option">Computer Generated Equation</a>
    </div>
    <div class="module-message">

    </div>
    </div>

    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
