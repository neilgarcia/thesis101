
                    //MODAL
                    // general settings
                    //
                    //
                    //
                    function fadeInResponse () {
          $('#bot-response').fadeIn(500);
        }
        function fadeOutResponse () {
          $('#bot-response').fadeOut(500);
        }
        function respond(){
          setTimeout(fadeInResponse, 100);
          setTimeout(fadeOutResponse, 5000);
        }
                    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                    '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                        '<div class="progress progress-striped active">' +
                            '<div class="progress-bar" style="width: 100%;"></div>' +
                        '</div>' +
                    '</div>';

                  $.fn.modalmanager.defaults.resize = true;

                    //ajax demo:

                     $('body').on('click', '#analyze',function(){
                        var eq = $('#input').val();  //GET VALUE
                        var given = $('#given-equation').text();
                        if(given == "")
                            given = "none";
                        else if(given != "none")
                            given = $('#given-equation').text().substring(7);
                        eq = eq.replace(/\//g, '|');
                        if(eq){
                                $.ajax({

                                    url: '/analyze/' + eq + '/given/' + given + '/method/manual',
                                    success: function(result){
                                        var data = jQuery.parseJSON(result);
                                        if($('#given-equation').text() == "")
                                            $('#given-equation').text("GIVEN: " + eq);

                                        if(data.distribute.length){

                                            $num = "";
                                            for (var i = 0; i < data.distribute.length; i++) {
                                                if($num == "")
                                                    $num = data.distribute[i];
                                                else if(i == data.distribute.length-1)
                                                    $num = $num + " and " + data.distribute[i];
                                                else
                                                    $num = $num + ", " + data.distribute[i];
                                            }
                                            $('.from-them p').text("The first thing you need to do is distribute " + $num + ".");
                                            respond();
                                        }
                                    }

                                });
                        }else{
                           $('.from-them p').text("Please input an equation");
                           respond();
                        }


                    });
