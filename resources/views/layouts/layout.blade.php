<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Kavivanar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/skitter.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/notie.min.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            background-color: #eee;
        }
        .footer-area {
            background: #333333 none repeat scroll 0 0;
            padding: 50px 0;
            text-align: center;
            width: 100%;
        }
        .copy-right {
        color: #ffffff;
        margin: 0;
        }
        .copy-right a{
            color: #ff305b;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .copy-right a:hover{
            text-decoration: none;
        }
        .footer-social-icon li {
            display: inline-block;
        }
        .footer-social-icon li a {
            color: #ffffff;
            display: block;
            height: 40px;
            font-size: 18px;
            line-height: 40px;
            padding: 0 10px;
        }
        .footer-social-icon li a:hover {
            color: #ff305b;
        }
        .active-link{
            border-bottom: 3px solid #333 !important;
        }
    </style>
    @yield('head')
    <title>Vetrova</title>
</head>
<body>

    {{-- @if($errors->any())
    <div class="alert alert-danger">
        <ul>
    @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
    @endforeach
        </ul>
    </div>
    @endif --}}


    @hasSection('navbar')
        @yield('name')
    @else
        @include("layouts.header")
    @endif


    @yield('content')


    
    @include("layouts.footer")
    @yield('footer')
</body>
</html>