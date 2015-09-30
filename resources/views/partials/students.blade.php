@extends('app')

@section('content')
<div class="background">

            </div>

    <div id="container">



            <div class="sidebar shadow">
                <div class="avatar">
                    <img src="images/avatar-female.png" width="100%" alt="">
                </div>
                <div class="chatbox">

                </div>
            </div>

            <div id="content" class="shadow">
                <h1>Given: 3(3x+5)=2x+16</h1>
                <span class="a-step">First Step: 9x+15=2x+16</span>
                <span class="a-step">Second Step: 9x-2x=16-15</span>
                <span class="a-step">Third Step: 7x=1</span>
                <span class="a-final">Final Answer: x=1/7</span>
            </div>

            <div class="chat">
                <form>
                    <input type="text" class="input" id="input">
                    <input type="button" class="button" id="analyze">
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
                                        alert(result);
                                    }
                                });
                        }else{
                           alert('Input your student number!');
                        }


                    });
                });
            </script>
@stop

