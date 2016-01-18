<?php

//   $file="demo.xls";
// $test="<table  ><tr><td>Cell 1</td><td>Cell 2</td></tr></table>";
// header("Content-type: application/vnd.ms-excel");
// header("Content-Disposition: attachment; filename=$file");


?>

<html>

  <table border = 1>
  <tr>
    <th>Student Name</th>
    <th>Equation</th>
    <th>Correct Solutions</th>
    <th>Wrong Solutions</th>
    <th>Total Steps</th>
    <th>Hints Used</th>
    <th>Number of Hints</th>
    <th>Status</th>
  </tr>
<?php $ctrCorrect =  0; ?>
<?php $ctrWrong =  0 ?>
<?php $hints_used = "" ?>
<?php $num_hints = 0; ?>
  @foreach ($logs as $log)
    @foreach ($log->equations as $equations)
        @foreach ($equations->logs as $steps)
          <tr>
          <td>{!! $equations->equation !!}</td>

          <td>{!! $steps->equation !!}</td>
          <td>{!! $steps->status !!}</td>
          <td>{!! $equations->status !!}</td>
          </tr>
        @endforeach

        @foreach ($equations->hints as $hints)
          {!! $hints->equation !!}
        @endforeach
    @endforeach
  @endforeach

  </table>
</html>
