        function fadeInResponse () {
          $('#bot-response').fadeIn(500);
        }
        function fadeOutResponse () {
          $('#bot-response').fadeOut(500);
        }
        function react(mood) {
            if(mood == "happy"){
                event.preventDefault();
                $('#embed embed').css("display", "none");
                $('#avatar-happy').css("display", "block");
            }else{
                $('#embed embed').css("display", "none");
                $('#avatar-sad').css("display", "block");
            }

        }
        function respond(type, error, num){
          if(arguments.length == 1){
            $('.from-them p').text("Congrats!");
            react("happy");
          }else if(arguments.length == 2){
            if(type == "simplifyLeft"){
                if(!error){

                    $('.from-them p').text("Simplify Left");
                    react("happy");
                }
                else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }
            }else{
                if(!error){
                    $('.from-them p').text("Simplify Right");
                    react("happy");
                }
                else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }

            }
          }else{
            if(type == "distribute"){
                if(!error){
                    $('.from-them p').text("Distribute " + num + ".");
                    react("happy");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }
            }else if(type == "left"){
                if(!error){
                    $('.from-them p').text("Move " + num + " to right");
                    react("happy");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }
            }else if(type == "right"){
                if(!error){
                    $('.from-them p').text("Move " + num + " to left");
                    react("happy");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }
            }else{
                if(!error){
                    $('.from-them p').text("Divide " + num[1] + " by " + num[0].substring(0, num[0].length-1) + " to simplify x.");
                    react("happy");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                    react("sad");
                }

            }
          }
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
                        $('#input').val("");
                        var given = $('#current-equation').val();
                        if(given == "")
                            given = "none";
                        else if(given != "none")
                            given = $('#current-equation').val();
                        eq = eq.replace(/\//g, '|');
                        given = given.replace(/\//g, '|');
                        if(eq){
                                $.ajax({

                                    url: '/analyze/' + eq + '/given/' + given + '/method/manual',

                                    success: function(result){
                                        video = document.getElementById('avatar-vid')[0];
                                        video.currentTime = 10;
                                        video.play();
                                        eq = eq.replace('|', '/');
                                        var data = jQuery.parseJSON(result);
                                        if($('#given-equation').text() == ""){

                                            $('#given-equation').text("GIVEN: " + eq);
                                            $('#current-equation').val(eq);
                                        }else if(!data.error){
                                            eq = eq.replace('|', '/');
                                            $('#current-equation').val(eq);
                                            $('#content').append("<span class=a-step>" + eq + "</span>");
                                        }

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

                                            respond("distribute", data.error, $num);
                                        }else if(data.left.length){
                                            $num = "";
                                            for (var i = 0; i < data.left.length; i++) {
                                                if($num == "")
                                                    $num = data.left[i];
                                                else if(i == data.left.length-1)
                                                    $num = $num + " and " + data.left[i];
                                                else
                                                    $num = $num + ", " + data.left[i];
                                            }
                                            respond("left", data.error, $num);
                                        }else if(data.right.length){
                                            $num = "";
                                            for (var i = 0; i < data.right.length; i++) {
                                                if($num == "")
                                                    $num = data.right[i];
                                                else if(i == data.right.length-1)
                                                    $num = $num + " and " + data.right[i];
                                                else
                                                    $num = $num + ", " + data.right[i];
                                            }
                                            respond("right", data.error, $num);
                                        }else if(data.simplifyleft == true){
                                            respond("simplifyLeft", data.error);
                                        }else if(data.simplifyright == true){
                                            respond("simplifyRight", data.error);
                                        }else if(data.finalAnswer){
                                            respond("finalAnswer");
                                        }else if(data.finalize.length){
                                            // $('.from-them p').text("Divide " + data.finalize[0].substring(0, data.finalize[0].length-1) + " from " + data.finalize[1] + " to simplify x.");
                                            respond("finalize", data.error, data.finalize);
                                        }
                                    }

                                });
                        }else{
                           $('.from-them p').text("Please input an equation");
                           respond();
                        }


                    });
