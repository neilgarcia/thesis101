
<!DOCTYPE Html>
<Html>
<head>
    <meta http-equiv="Content-Type" content="text/Html; charset=UTF-8">
    <title>UNIVERSITY OF THE EAST Freshmen Orientation {{ Carbon::now() }}</title>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    {!! Html::style('/css/bootstrap.min.css') !!}

    <!-- Optional theme -->
    {!! Html::style('/css/bootstrap-theme.css') !!}

    <!-- Latest compiled and minified JavaScript -->
    {!! Html::script('/js/bootstrap.min.js') !!}
    {!! Html::style('/css/modalfix.css') !!}
    {!! HTML::style('/css/bootstrap-modal.css') !!}

    {!! HTML::script('/js/bootstrap-modal.js') !!}
    {!! HTML::script('/js/bootstrap-modalmanager.js') !!}
    {!! Html::style('/css/style.css') !!}
    {!! Html::style('/css/sidebarinput.css') !!}
    {!! Html::style('/css/sidebarfield.css') !!}

</head>
<body>

    @yield('content')

    <!-- Scripts -->
    {!! Html::script('js/core.js') !!}
    {!! Html::script('js/login.js') !!}

</body>
</Html>
