<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    {!! Form::open(array('class'=>'form-signup')) !!}
    {!! Form::text('firstname', null, array('placeholder'=>'Enter your first name.', 'class'=>'btn text-signup')) !!}
    {!! Form::text('lastname', null, array('placeholder'=>'Enter your last name.', 'class'=>'btn text-signup')) !!}
    {!! Form::text('studentnumber', null, array('placeholder'=>'Enter your student number.', 'class'=>'btn text-signup')) !!}
    {!! Form::submit('Signup', array('class'=>'btn btn-signup')) !!}
    {!! Form::close() !!}
</body>
</html>
