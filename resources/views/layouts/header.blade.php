<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">PIA: Personal Instructing Agent</a>
    </div>
    <center>
      <div class="navbar-collapse collapse" id="navbar-main">

        <ul class="nav navbar-nav navbar-right">
          <li><p class="navbar-text">Already have an account?</p></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
              <li>
               <div class="row">
                <div class="col-md-12">
                {!! Form::open(array('method'=>'post', 'url'=>'pia/login', 'class'=>'form')) !!}
                    <div class="form-group">
                     {!! Form::text('student_number', null, array('class'=>'form-control', 'placeholder'=>'Student Number')) !!}
                   </div>
                   <div class="form-group">

                     {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) !!}

                   </div>
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                   </div>
                 {!! Form::close() !!}
               </div>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</center>
</div>
</div>
