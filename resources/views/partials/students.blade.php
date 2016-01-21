@extends('app')

@section('csrf')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('css')

  {!! Html::style('/css/font-awesome.min.css') !!}
  {!! Html::style('/css/style.css') !!}

@stop

@section('js')
{!! Html::script('js/core.js') !!}
    {!! Html::script('js/login.js') !!}
    {!! Html::script('/js/bootstrap-dialog.min.js') !!}
  @if ($method == "auto")
    <script type="text/javascript" src="/js/autosolve.js"></script>
  @else
    <script type="text/javascript" src="/js/manualsolve.js"></script>
  @endif


@stop

@section('content')


        <div id="container">

            <div class="sidebar shadow">

                <div class="avatar">
                <section id="bot-response">

                        <div class="from-them">
                        <p>Hello {!! $user->first_name !!}. I am PIA and
                        I'm here to teach you about the basics of linear equations.
                        Please click on the New Problem icon on the right side of the board to start.</p>
                      </div>
                </section>
                     {{--                    <object >
                     <param name="allowScriptAccess" value="sameDomain" />
                     <param name="allowFullScreen" value="false" />
                     <param name="movie" value="/images/reactions/welcome.swf" /> --}}
                  <div id="embed">
                    <video id="avatar-vid" preload>
                    <source src="/images/reactions/reactions.webm" type="video/webm">
                      {{-- <source src="/images/reactions/output.mp4" type="video/mp4"> --}}
                    </video>
                  </div>

                </div>
                <div class="chatbox shadow">
                  <h1>User Logs</h1>
                  <div class="chat-logs nano">
                      <div class="nano-content">

                      </div>
                  </div>
                </div>
            </div>
            <div class="tab-content" >
            <div class="tab-pane fade" id="lecture-board">
                <a href="#content" class="top" role="tab" data-toggle="tab">
                  <span class="glyphicon glyphicon-circle-arrow-left close-lecture"></span>
                </a>
                <embed src="/images/Lecture.swf" style="position: absolute; z-index: 0" wmode="opaque">
            </div>
            <div id="content" class="shadow tab-pane fade active in">

            <div class="helper">

            <div class="icon-container hint ">
              <span class="glyphicon glyphicon-question-sign icon-hint"></span>
              <span id="hint-message">Hint</span>
            </div>
            <div class="clear"></div>
            <div class="icon-container clear-board">
              <span class="glyphicon glyphicon-erase icon-clear-board"></span>
              <span id="board-message">Erase Board</span>
            </div>
            <div class="clear"></div>
            <div class="icon-container abandon">
              <span class="glyphicon glyphicon-folder-close icon-abandon"></span>
              <span id="abandon-message">New Problem</span>
            </div>
            <div class="clear"></div>
            <div class="icon-container lecture">
              <a href="#lecture-board" role="tab" data-toggle="tab">
                <span class="glyphicon glyphicon-blackboard icon-lecture"></span>
                <span id="lecture-message">Lecture</span>
              </a>
            </div>
            </div>
              @if (isset($given))
                    <h1 class="given" id="given-equation">Given: {!! $given !!}</h1>
                  @else
                    <h1 class="given" id="given-equation"></h1>
                  @endif
              <input type="hidden" id="current-equation" value={!! isset($given) ? $given : "" !!} autocomplete="off">
              <input type="hidden" id="input-correct-ctr" value=0 autocomplete="off">
              <input type="hidden" id="input-wrong-ctr" value=0 autocomplete="off">
              <form method="post" id="form-log">
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                @if (isset($given))
                  <input type="hidden" name="equation_id" id="equation_id" value={!! $id !!} autocomplete="off">
                  <input type="hidden" name="equation" id="input-given" value={!! $given !!} autocomplete="off">
                @else
                  <input type="hidden" name="equation_id" id="equation_id" autocomplete="off">
                  <input type="hidden" name="equation" id="input-given" autocomplete="off">
                @endif

                <input type="hidden" name="correct" id="input-correct" value=0 autocomplete="off">
                <input type="hidden" name="wrong" id="input-wrong" value=0 autocomplete="off">
                <input type="hidden" name="hints_used" id="hints-used" value=0 autocomplete="off">
              </form>
              <div id="content-board">

              </div>
            </div>
            </div>
            <div class="chat">
                <form>
                    <input type="text" class="input" id="input">
                    <input type="button" class="button" value="Submit" id="analyze">
                </form>

            </div>

        </div>

@stop

