{!! Form::open(array('method'=>'POST', 'id'=>'form')) !!}

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Student Info</h4>
      </div>
      <div class="modal-body">
        <p>Name: {!! $user->firstname . " " . $user->lastname !!}</p>
        <p>Student Number: {!! $user->sn !!}</p>
        <p>Mother's Name: {!! $user->Mother !!}</p>
        <p>Father's Name: {!! $user->Father !!}</p>
        <p>Contact Number: {!! Form::text('ContactNumber', null) !!}</p>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        {!! Form::submit('Submit', array('class'=>'btn btn-default', 'id'=>'update')) !!}
      </div>
    </div>

{!! Form::close() !!}

<script type="text/javascript">
  $(document).ready(function(){

  $('#form').submit(function(e){
    $form = $(this);
    e.preventDefault();
    $.ajax({
    type: $form.attr('method'),
    url: $form.attr('action'),
    data: $form.serialize(),
    success: function(data) {
      $('#ajax-modal').modal('hide');
      $('#student_number').val('');
      $('#student_number').focus();
    }
    });

  })


});

</script>
