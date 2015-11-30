window.onload = initialize;

function initialize(){

    $(document).ready(function(){

        placeForm();
        var parent = $('embed#avatar').parent();
        var newAvatar = "<embed src='/images/reactions/welcome.swf' id='avatar' width='100%' loop='false'>";

        $('embed#avatar').remove();
        parent.append(newAvatar);

    });
}







