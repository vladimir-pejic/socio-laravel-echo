<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="_token" id="token" content="{{ csrf_token() }}">--}}
    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://use.fontawesome.com/b49559a715.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="margin-top: 70px">
@include('includes.header')
<div class="container"  id="app">
    <div class="row">
        @yield('content')
    </div>
</div>

@include('includes.modals')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>