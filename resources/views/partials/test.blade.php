<?php

use Carbon\Carbon;

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

?>

<html>


<?php $ctrCorrect =  0; ?>
<?php $ctrWrong =  0 ?>
<?php $hints_used = "" ?>
<?php $emotion_count = 0; ?>
<?php $hint_count = 0; ?>
<?php $responses = array("Good Job!",
                       "Keep it up!",
                       "You're doing great.",
                       "Nice",
                       "You're one of a kind!",
                       "Very Good!",
                       "Congratulations!",
                       "Congrats!",
                       "You're doing a pretty good job",
                       "Well Played!",
                       "That's the way to do it!",
                       "Amazing! That's right!",
                       "Yahoo! You're pretty good.") ?>
  @foreach ($logs as $log)
  <table border = 1>
  <tr>
    <th colspan=6>Student Name</th>
  </tr>
  <tr><td colspan=6>{!! $log->first_name . " " . $log->last_name !!}</td></tr>
    <tr>
    <td>Equations</td>
    <td>Difficulty</td>
    <td>Status</td>
    <td>Hints Said</td>
    <td>Number of Assist</td>
    <td>Emotions Exhibited</td>
    <td>Time Started</td>
    <td>Time Finished</td>
    <td>Time Spent</td>
  </tr>
  @foreach ($log->equations as $equation)
  <tr>
    <td>{!! $equation->equation !!}</td>
    <td>{!! $equation->difficulty !!}</td>
    <td>{!! $equation->status !!}</td>
    <?php $hint_said = ""; ?>
    @foreach ($equation->PiaLogs as $plogs)
      <?php in_array($plogs->reaction, $responses) ? "" : $hint_said .= $plogs->reaction ?>
      <?php in_array($plogs->reaction, $responses) ? "" : $hint_count++; ?>
    @endforeach
    <td>{!! $hint_said !!}</td>
    <td>{!! $equation->hints->count() !!}</td>

    <?php $emotion_exhibited = ""; ?>
    @foreach ($equation->logs as $emotion)
      <?php $emotion_exhibited = $emotion_exhibited . $emotion->emotion . " "?>
      <?php $emotion_count++; ?>
    @endforeach
    <td>{!! $emotion_exhibited !!}</td>
    <td>{!! $equation->time_started !!}</td>
    <td>{!! $equation->time_finished !!}</td>
    <td>{!! strtotime($equation->time_finished) != 0 ? strtotime($equation->time_finished) - strtotime($equation->time_started) : "N/A" !!}</td>
  </tr>
  @endforeach

  </table>

  @endforeach
  <?php echo "hint count: " . $hint_count . "<br>" . "emotion count: " . $emotion_count ?>
</html>
