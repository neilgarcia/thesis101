@extends('app')

@section('content')


        <div id="container">



            <div class="sidebar shadow">
                <div class="avatar">
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
            <script type="text/javascript">
                $( document ).ready(function() {

                    //MODAL
                    // general settings
                    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                    '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                        '<div class="progress progress-striped active">' +
                            '<div class="progress-bar" style="width: 100%;"></div>' +
                        '</div>' +
                    '</div>';

                    $.fn.modalmanager.defaults.resize = true;

                    //ajax demo:

                     $('body').on('click', '#analyze',function(){
                        var a = $('#input').val();  //GET VALUE
                        a = a.replace(/\//g, '|');
                        if(a){
                                $.ajax({

                                    url: '/analyze/' + a,
                                    success: function(result){
                                        $('div#content').html(result);
                                        $(".avatar > object > embed").attr("src", "/images/reactions/welcome-new.swf");
                                    }
                                });
                        }else{
                           alert('Input your student number!');
                        }


                    });
                });
            </script>
@stop

