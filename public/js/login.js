window.onload = initialize;

function initialize(){

    $(document).ready(function(){

        placeForm();

        // var parent = $('embed#avatar').parent();
        // var newAvatar = "<embed src='/images/reactions/welcome.swf' id='avatar' width='100%' loop='false'>";
        $('#avatar-welcome').css("display", "block");
        // $('embed#avatar').remove();
        // parent.append(newAvatar);
        function fadeInResponse () {
          $('#bot-response').fadeIn(500);
        }
        function fadeOutResponse () {
          $('#bot-response').fadeOut(500);
        }
        function respond(){
          setTimeout(fadeInResponse, 800);
          setTimeout(fadeOutResponse, 5000);
        }

        respond();


    });
}







