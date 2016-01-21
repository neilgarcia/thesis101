@extends('app')

@section('css')
  {!! Html::style('/css/bootstrap-table.min.css') !!}
  {!! Html::style('/css/profile.css') !!}
@stop

@section('js')
  {!! HTML::script('/js/bootstrap-table.min.js') !!}
  {!! HTML::script('/js/bootstrap-table-zh-CN.min.js') !!}
  <script>
    $(document).ready(function() {
      $('#equations-table').DataTable({bFilter: false, bInfo: false, bLengthChange: false });
      $('#wrong-table').DataTable({bFilter: false, bInfo: false, bLengthChange: false});
    } );
  </script>
@stop

@section('content')
    {{-- <div class="sidebar">
        <ul class="sidebar-contents">
          <li></li>
          <li></li>
        </ul>
    </div> --}}
      <div class="category list">
      <a class="item item-icon-left" href="#equations" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-asterisk"></span>
        Number of Equations Encountered

        <span class="badge badge-stable">{!! $equations->count() !!}</span>
      </a>
      <div id="equations" class="collapse">
      <div class="list-content">
      <table id="equations-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($equations as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>{!! $equation->status !!}</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>

      <a class="item item-icon-left" href="#correct" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-ok"></span>
        Number of Equations Answered Correctly

        <span class="badge badge-stable">{!! $correctEquations->count() !!}</span>
      </a>

      <div id="correct" class="collapse">
      <div class="list-content">
      <table id="correct-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($correctEquations as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>{!! $equation->time_started !!}</td>
                  <td>{!! $equation->time_finished !!}</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#wrong" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-remove"></span>
        Number of Equations Abandoned

        <span class="badge badge-stable">{!! $wrongEquations->count() !!}</span>

      </a>
      <div id="wrong" class="collapse">
      <div class="list-content">
      <table id="wrong-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($wrongEquations as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>N/A</td>
                  <td>N/A</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#easy" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-tag"></span>
        Number of Easy Questions Answered Correctly

        <span class="badge badge-stable">{!! $easy->count() !!}</span>
      </a>
      <div id="easy" class="collapse">
      <div class="list-content">
      <table id="easy-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($easy as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>{!! $equation->time_started !!}</td>
                  <td>{!! $equation->time_finished !!}</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#average" data-toggle="collapse">
      {{-- <i class="calm icon flaticon-open182"></i> --}}
      <span class="glyphicon icon glyphicon-tags"></span>
        Number of Average Questions Answered Correctly

        <span class="badge badge-stable">{!! $average->count() !!}</span>
      </a>
      <div id="average" class="collapse">
      <div class="list-content">
      <table id="average-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($average as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>{!! $equation->time_started !!}</td>
                  <td>{!! $equation->time_finished !!}</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#difficult" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-book"></span>
        Number of Hard Questions Answered Correctly

        <span class="badge badge-stable">{!! $difficult->count() !!}</span>
      </a>
      <div id="difficult" class="collapse">
      <div class="list-content">
      <table id="difficult-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equation ID</th>
                <th>Equation</th>
                <th>Time Started</th>
                <th>Time Ended</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($difficult as $equation)
              <tr>
                  <td>{!! $equation->equation_id !!}</td>
                  <td>{!! $equation->equation !!}</td>
                  <td>{!! $equation->time_started !!}</td>
                  <td>{!! $equation->time_finished !!}</td>
              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#hint" data-toggle="collapse">
      <span class="glyphicon icon glyphicon-question-sign"></span>
        Total Number of Hints Used

        <span class="badge badge-stable">{!! $hints->count() !!}</span>
      </a>
      <div id="hint" class="collapse">
      <div class="list-content">
      <table id="hint-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Hint ID</th>
                <th>Equation</th>
                <th>Hint</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Hint ID</th>
                <th>Equation</th>
                <th>Hint</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($hints as $equation)
              <tr>
                  <td>{!! $equation->hint_id !!}</td>
                  <td>{!! $equation->equation()->first()->equation !!}</td>
                  <td>{!! $equation->equation !!}</td>

              </tr>
            @endforeach
        </tbody>
       </table>
      </div>
      </div>
      <a class="item item-icon-left" href="#">
      <span class="glyphicon icon glyphicon-education"></span>
        Level

        <span class="badge badge-stable">Novice</span>
      </a>
    </div>

@stop
