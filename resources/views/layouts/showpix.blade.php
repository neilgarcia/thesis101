<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  @foreach ($sn as $studentnumber)
    <img src="https://www.ue.edu.ph/studentsportal/showpix.php?id={!! $studentnumber !!}" width="140" heigh="140">
  @endforeach
</body>
</html>
