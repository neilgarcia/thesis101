
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

                                    url: '/analyze/' + a + '/method/auto',
                                    success: function(result){
                                        $('div#content').html(result);
                                        // $(".avatar > object > embed").attr("src", "/images/reactions/welcome-new.swf");
                                    }
                                });
                        }else{
                           $('.from-them p').text("Please input an equation");
                           respond();
                        }


                    });

function fadeInResponse () {
          $('#bot-response').fadeIn(500);
        }
        function fadeOutResponse () {
          $('#bot-response').fadeOut(500);
        }
        function respond(){
          setTimeout(fadeInResponse, 800);
          setTimeout(fadeOutResponse, 3000);
        }
