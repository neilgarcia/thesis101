$(document).ready(function(){
  $('#btn-signin').on('click', function(e){
    e.preventDefault();
    data = $('#form-signin').serialize();
    $.ajax({
        url: '/pia/login',
        method: 'post',
        data: data,
        beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
        success: function(e){
            // console.log(e);
        }
    });
  });
});
