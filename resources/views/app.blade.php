<Html>
<head>
    <meta http-equiv="Content-Type" content="text/Html; charset=UTF-8">
    @yield('csrf');
    <title>UNIVERSITY OF THE EAST Freshmen Orientation {{ Carbon::now() }}</title>

    <!-- Latest compiled and minified CSS -->
    {!! Html::style('/css/bootstrap.min.css') !!}
    {{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css"> --}}
    {!! HTML::style('/css/font-awesome.min.css') !!}
    {!! Html::script('/js/jquery.js') !!}
    <!-- Optional theme -->
    {!! Html::style('/css/bootstrap-theme.min.css') !!}
    {!! HTML::style('/css/bootstrap-dialog.min.css') !!}
    <!-- Latest compiled and minified JavaScript -->
    {!! Html::script('/js/bootstrap.min.js') !!}

    {{-- {!! Html::style('/css/modalfix.css') !!} --}}
    {{-- {!! HTML::style('/css/bootstrap-modal.css') !!} --}}
    {{-- {!! HTML::script('/js/bootstrap-modal.js') !!} --}}

    {{-- {!! HTML::script('/js/bootstrap-modalmanager.js') !!} --}}
    {!! Html::style('/css/style.css') !!}
    {!! Html::style('/css/sidebarinput.css') !!}
    {!! Html::style('/css/sidebarfield.css') !!}
</head>
<body>
    @include('layouts.header');
    @yield('content')

    <!-- Scripts -->
    {!! Html::script('js/core.js') !!}
    {!! Html::script('js/login.js') !!}
    {!! HTML::script('/js/bootstrap-dialog.min.js') !!}
    @yield('js')
</body>
</Html>
