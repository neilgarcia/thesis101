<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="/pia">
      <span class="glyphicon glyphicon-education" style="top: 3px;margin-right: 3px;font-size:32px;top: -4px;left: 18px;"></span>
        <p style="display: inline-block;position: relative;top: -14px;left: 30px;font-weight: 600;">PIA: Personal Instructing Agent</p>
      </a>
    </div>

      <div class="navbar-collapse collapse" id="navbar-main">
        @if ($user)
      <ul class="nav navbar-nav navbar-right">

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b id="user-name">{!! $user->first_name !!}</b> <span class="caret"></span></a>

              <ul class="dropdown-menu">
                  <li><a href="/pia/user/profile"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;My Account</a></li>
                  <li><a href="/pia/user/logs"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;&nbsp;&nbsp;My Logs</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/pia/logout"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;&nbsp;Logout</a></li>
                </ul>

      </li>
      </ul>
        @else
        <ul id="menu" class="nav navbar-nav navbar-right">
          <li data-menuanchor="register"><a href="#register">Register</a></li>
          <li data-menuanchor="login"><a href="#login">Login</a></li>
          <li data-menuanchor="modules"><a href="#modules">Modules</a></li>
          <li data-menuanchor="aboutus"><a href="#aboutus">About Us</a></li>
          <li data-menuanchor="contactus"><a href="#contactus">Contact Us</a></li>
        </ul>
          {{--  <ul class="nav navbar-nav navbar-right">
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
    </ul>  --}}
        @endif

  </div>

</div>
</div>
