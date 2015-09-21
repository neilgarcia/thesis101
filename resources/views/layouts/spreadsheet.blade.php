<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title></title>
  <style>
  table, th, td {
     border: 1px solid black;
      padding: 3px;
  }
  table {
    border-collapse: collapse;
  }
  .page-break {
    page-break-after: always;
  }
</style>
</head>
<body>
  <center>
  <h1>TEST TITLE</h1>
  <table border="1" width="700px">

    <tr>
      <th>Student Name</th>
      <th>Student Number</th>
      <th>Attended</th>
      <th>Contact Number</th>
      <th>Signature</th>
    </tr>

     @foreach ($students as $user)
      <tr>
        <td>{!! $user->lastname . ', ' .$user->firstname !!}</td>
        <td>{!! $user->sn !!}</td>
        <td>{!! $user->attended !!}</td>
        <td>{!! $user->ContactNumber !!}</td>
        <td></td>
      </tr>
    @endforeach

  </table>

</body>
</html>
