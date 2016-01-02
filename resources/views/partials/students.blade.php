@extends('app')

@section('js')
  <script type="text/javascript" src="/js/autosolve.js"></script>
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
                     <embed src="/images/reactions/welcome.swf" loop="false">
                     {{-- </object> --}}
                </div>
                <div class="chatbox">

                </div>
            </div>

            <div id="content" class="shadow">

            </div>

            <div class="chat">
                <form>
                    <input type="text" class="input" id="input">
                    <input type="button" class="button" value="Submit" id="analyze">
                </form>

            </div>

        </div>
        <!--MODAL-->
            <div id="ajax-modal" class="modal fade" tabindex="-1" ></div>
            <!--END MODAL-->

@stop

