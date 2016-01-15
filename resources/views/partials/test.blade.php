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
         {{-- {!! $steps->equation !!} --}}
      @endforeach
      <div class="clear"></div>
      @foreach ($equations->hints as $hints)
        {{-- {!! $hints->equation !!} --}}
      @endforeach

      <tr>
      <td>{!! $log->first_name . " " . $log->last_name !!}</td>
      <td>{!! $equations->equation !!}</td>
      <td>{!! $ctrCorrect !!}</td>
      <td>{!! $ctrWrong !!}</td>
      <td>{!! $ctrCorrect + $ctrWrong !!}</td>
      <td>{!! $hints_used !!}</td>
      <td>{!! $num_hints !!}</td>
      <td>{!! $equations->status !!}</td>
      </tr>
    @endforeach
  @endforeach

  </table>
</html>
