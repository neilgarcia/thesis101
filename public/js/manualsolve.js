        function fadeInResponse () {
          $('#bot-response').fadeIn(500);
        }
        function fadeOutResponse () {
          $('#bot-response').fadeOut(500);
        }
        function setIdle() {
            video = document.getElementById('avatar-vid');
            video.currentTime = 13;
        }

        function react(mood) {
            // alert(mood);
            video = document.getElementById('avatar-vid');

            if(mood == "happy"){
                video.currentTime = 2.3;
                setTimeout(setIdle, 1900);
            }else if(mood == "sad"){
                video.currentTime = 10.5;
                setTimeout(setIdle, 1800);
            }else if(mood == "surprised"){
                video.currentTime = 8.2;
                setTimeout(setIdle, 1400);
            }else{
                video.currentTime = 5.4;
                setTimeout(setIdle, 2000);
            }

        }
        function respond(mood, type, error, num){
          setTimeout(fadeInResponse, 100);
          setTimeout(fadeOutResponse, 5000);
          if(arguments.length == 1){
            $('.from-them p').text("Congrats!");
            react("excited");
          }else if(arguments.length == 3){
            if(type == "simplifyLeft"){
                if(!error){
                    $('.from-them p').text("Simplify Left");
                }
                else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);
            }else{
                if(!error){
                    $('.from-them p').text("Simplify Right");
                }
                else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);
            }
          }else{
            if(type == "distribute"){
                if(!error){
                    $('.from-them p').text("Distribute " + num + ".");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);
            }else if(type == "left"){
                if(!error){
                    $('.from-them p').text("Move " + num + " to right");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);
            }else if(type == "right"){
                if(!error){
                    $('.from-them p').text("Move " + num + " to left");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);
            }else{
                if(!error){
                    $('.from-them p').text("Divide " + num[1] + " by " + num[0].substring(0, num[0].length-1) + " to simplify x.");
                }else{
                    $('.from-them p').text("Something seems wrong.");
                }
                react(mood);

            }
          }

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
                                        mood = "happy";
                                        eq = eq.replace('|', '/');
                                        var data = jQuery.parseJSON(result);
                                        if($('#given-equation').text() == ""){
                                            $('#given-equation').text("GIVEN: " + eq);
                                            $('#current-equation').val(eq);
                                        }else if(!data.error){
                                            correct = $('#input-correct').val();
                                            wrong = $('#input-wrong').val();
                                            if(correct >= 2){
                                                mood = "excited";
                                            }else if(wrong >= 3){
                                                mood = "surprised";
                                            }else{
                                                mood = "happy";
                                            }
                                            $('#input-correct').val(parseInt(correct) + 1);
                                            $('#input-wrong').val(0);
                                            eq = eq.replace('|', '/');
                                            $('#current-equation').val(eq);
                                            $('#content').append("<span class=a-step>" + eq + "</span>");
                                        }else{
                                            wrong = $('#input-wrong').val();
                                            correct = $('#input-correct').val();
                                            if(correct >= 3){
                                                mood = "surprised";
                                            }else{
                                                mood = "sad";
                                            }
                                            $('#input-wrong').val(parseInt(wrong) + 1);
                                            $('#input-correct').val(0);
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

                                            respond(mood, "distribute", data.error, $num);
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

                                            respond(mood, "left", data.error, $num);
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
                                            respond(mood, "right", data.error, $num);
                                        }else if(data.simplifyleft == true){
                                            respond(mood, "simplifyLeft", data.error);
                                        }else if(data.simplifyright == true){
                                            respond(mood, "simplifyRight", data.error);
                                        }else if(data.finalAnswer){
                                            respond("finalAnswer");

                                        }else if(data.finalize.length){
                                            // $('.from-them p').text("Divide " + data.finalize[0].substring(0, data.finalize[0].length-1) + " from " + data.finalize[1] + " to simplify x.");
                                            respond(mood, "finalize", data.error, data.finalize);
                                        }
                                    }

                                });
                        }else{
                           $('.from-them p').text("Please input an equation");
                           respond();
                        }


                    });
