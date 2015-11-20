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
    <div class="content">
      {!! Form::open(array('class'=>'form-signup')) !!}
      {!! Form::text('firstname', null, array('placeholder'=>'Enter your first name.', 'class'=>'txt text-signup')) !!}
      {!! Form::text('lastname', null, array('placeholder'=>'Enter your last name.', 'class'=>'txt text-signup')) !!}
      {!! Form::text('studentnumber', null, array('placeholder'=>'Enter your student number.', 'class'=>'txt text-signup')) !!}
      {!! Form::submit('Sign me up!', array('class'=>'txt btn-signup')) !!}
      {!! Form::close() !!}

    <div class="message">
        <h1>Personal Instructing Agent</h1>
        <h2>An intelligent tutoring system built for students learning linear equations. Register now and be a part of the group!</h2>
    </div>
    </div>

</body>
</html>
