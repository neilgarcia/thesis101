
$(document).ready(function(){





        $('#form-log').on('submit', function(e){
            e.preventDefault();
            data = $('#form-log').serialize();
            // alert(data);
            $.ajax({
                url: '/pia/finished',
                method: 'post',
                data: data,
                success: function(e){
                    // console.log(e);
                }
            });
            $('#input').attr('disabled', 'disabled');

        });

        $('.hint').on('click', function(e){
            eq = '';
            if($('#current-equation').val()){
                eq = $('#current-equation').val();
            }else if($('#input-given').val()){
                eq = $('#input-given').val();
            }else{
                $('.from-them p').text("Please input an equation first.");
                respond();
                return;
            }

            $.ajax({
                url: '/analyze/' + eq + '/given/' + eq + '/method/hint',
                success: function(result){
                    id = $('#equation_id').val();
                    $('#content-board').append("<span class=a-step>" + result + "</span>");
                    $('#current-equation').val(result);
                    saveHint(result, id);
                }
            });
        });

        $('.abandon').on('click', function(){
            BootstrapDialog.show({
                title: 'Confirm',
                message: 'Are you sure you want to abandon the equation?',
                buttons: [{
                    label: 'Yes',
                    cssClass: 'btn-primary',
                    action: function(){
                        $('#given-equation').text("");
                        $('#current-equation').val("");
                        $('#input-given').val("");
                        $('#content-board').html("");
                    }
                },{
                    label: 'No',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });


        });

        $('.clear-board').on('click', function(){
            BootstrapDialog.show({
                title: 'Confirm',
                message: 'Are you sure you want to clear the board?',
                buttons: [{
                    label: 'Yes',
                    cssClass: 'btn-primary',
                    action: function(){
                        $('#content-board').html("");
                    }
                },{
                    label: 'No',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });

        });

        function saveEquation (equation) {

            $.ajax({
                method: 'post',
                data: { 'equation': equation },
                url: '/pia/saveEquation',
                beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                success: function(result){
                    $('#equation_id').val(result);
                    console.log("success!");
                }
            });
        }

        function saveLog (eq, id, status, emotion) {
            $.ajax({
                method: 'post',
                url: '/pia/savelogs',
                data : { 'equation': eq, 'id':id, 'status': status, 'mood': emotion },
                beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                success: function(result){
                    console.log("logs saved!");
                }
            });
        }


        function saveHint (eq, id) {
            $.ajax({
                url: '/pia/savehint',
                method: "post",
                data: { 'equation': eq, 'id': id},
                beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                success: function(e){
                    console.log(e);
                },error: function(xhr, status, error) {
                  // var err = eval("(" + xhr.responseText + ")");
                  console.log(error);
                }
            });
        }

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
          }else if(arguments.length == 4){
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
                  // $.fn.modalmanager.defaults.resize = true;

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
                                        eq2 = eq.replace('|', '/');
                                        eqID = $('#equation_id').val();
                                        var data = jQuery.parseJSON(result);
                                        if($('#given-equation').text() == ""){
                                            saveEquation(eq);
                                            $('#given-equation').text("GIVEN: " + eq2);
                                            $('#current-equation').val(eq2);
                                            $('#input-given').val(eq2);
                                        }else if(!data.error){
                                            correct = $('#input-correct-ctr').val();
                                            wrong = $('#input-wrong-ctr').val();
                                            if(correct >= 2){
                                                mood = "excited";
                                            }else if(wrong >= 3){
                                                mood = "surprised";
                                            }else{
                                                mood = "happy";
                                            }
                                            saveLog(eq, eqID, 'correct', mood);
                                            $('#input-correct').val(parseInt($('#input-correct').val()) + 1);
                                            $('#input-correct-ctr').val(parseInt(correct) + 1);
                                            $('#input-wrong-ctr').val(0);
                                            $('#current-equation').val(eq2);
                                            $('#content-board').append("<span class=a-step>" + eq2 + "</span>");
                                        }else{
                                            wrong = $('#input-wrong-ctr').val();
                                            correct = $('#input-correct-ctr').val();
                                            if(correct >= 3){
                                                mood = "surprised";
                                            }else{
                                                mood = "sad";
                                            }
                                            saveLog(eq, eqID, 'wrong', mood);
                                            $('#input-wrong').val(parseInt($('#input-wrong').val()) + 1);
                                            $('#input-wrong-ctr').val(parseInt(wrong) + 1);
                                            $('#input-correct-ctr').val(0);
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
                                            $('#form-log').submit();
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

});


