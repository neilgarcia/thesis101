<Html>
<head>
    <meta http-equiv="Content-Type" content="text/Html; charset=UTF-8">
    <meta id="token" name="token" content="{{ csrf_token() }}">
    <title>UNIVERSITY OF THE EAST Freshmen Orientation {{ Carbon::now() }}</title>

    <!-- Latest compiled and minified CSS -->
    {!! Html::style('/css/bootstrap.min.css') !!}
    @yield('css')
    {!! HTML::style('/css/nanoscroller.css') !!}
    {{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css"> --}}

    {!! Html::script('/js/jquery.js') !!}
    {!! HTML::script('/js/nanoscroller.min.js') !!}
    <!-- Optional theme -->
    {!! Html::style('/css/bootstrap-theme.min.css') !!}
    {!! HTML::style('/css/bootstrap-dialog.min.css') !!}
    <!-- Latest compiled and minified JavaScript -->
    {!! Html::script('/js/bootstrap.min.js') !!}
    </head>
<body>
    @include('layouts.header')
    @yield('content')

    <!-- Scripts -->
    @yield('js')

</body>
</Html>
