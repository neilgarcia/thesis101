@extends('app')

@section('csrf')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('js')
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
                        First input an equation and Ill help you solve it step by step.</p>
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
                <div class="chatbox">

                </div>
            </div>

            <div id="content" class="shadow">

            <div class="helper">

            <div class="icon-container hint">
              <span class="glyphicon glyphicon-question-sign icon-hint"></span>
              <span id="hint-message">Hint.</span>
            </div>
            <div class="clear"></div>
            <div class="icon-container clear-board">
              <span class="glyphicon glyphicon-blackboard icon-clear-board"></span>
              <span id="board-message">Clear</span>
            </div>
            <div class="clear"></div>
            <div class="icon-container abandon">
              <span class="glyphicon glyphicon-trash icon-abandon"></span>
              <span id="abandon-message">Abandon</span>
            </div>

            </div>
              <h1 class="given" id="given-equation"></h1>
              <input type="hidden" id="current-equation" autocomplete="off">
              <input type="hidden" id="input-correct-ctr" value=0 autocomplete="off">
              <input type="hidden" id="input-wrong-ctr" value=0 autocomplete="off">
              <form method="post" action="/pia/finished" id="form-log">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="equation_id" id="equation_id" autocomplete="off">
                <input type="hidden" name="equation" id="input-given" autocomplete="off">
                <input type="hidden" name="correct" id="input-correct" value=0 autocomplete="off">
                <input type="hidden" name="wrong" id="input-wrong" value=0 autocomplete="off">
                <input type="hidden" name="hints_used" id="hints-used" value=0 autocomplete="off">
              </form>
              <div id="content-board"></div>
            </div>

            <div class="chat">
                <form>
                    <input type="text" class="input" id="input">
                    <input type="button" class="button" value="Submit" id="analyze">
                </form>

            </div>

        </div>

@stop

