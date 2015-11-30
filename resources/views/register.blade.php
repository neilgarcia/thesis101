<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/register-style.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="/js/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>

</head>
<body>
    @include('layouts.header')
    <div class="content">
      {!! Form::open(array('class'=>'form-signup', 'method'=>'POST', 'url'=>'pia')) !!}
      {!! Form::text('student_number', null, array('placeholder'=>'Enter your student number...', 'class'=>'txt text-signup')) !!}
      {!! Form::text('first_name', null, array('placeholder'=>'Enter your first name...', 'class'=>'txt text-signup')) !!}
      {!! Form::text('last_name', null, array('placeholder'=>'Enter your last name...', 'class'=>'txt text-signup')) !!}
      {!! Form::submit('Sign me up!', array('class'=>'txt btn-signup')) !!}
      {!! Form::close() !!}

    <div class="message">
        <h1>Personal Instructing Agent</h1>
        <h2>An intelligent tutoring system built for students learning linear equations. Register now and be a part of the group!</h2>
    </div>
    </div>

</body>
</html>
