<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600" rel="stylesheet" type="text/css"> -->
        
        <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
        
        
        


        <!-- Styles -->
        <style>
            body {
                min-height: 100vh;
                background-color: #243949;
                color: white;
                
                background-repeat: no-repeat;
                background-size: 1380px 800px;
                
                background-image: url("../img/pos8.jpg");
            }
            .navbar-default {
                background-color: black;
                border: none;
            }
            .navbar-static-top {
                margin-bottom: 19px;
            }
            .navbar-default .navbar-nav>li>a {
                color: #fff;
                font-weight: 600;
                font-size: 15px
            }
            .navbar-default .navbar-nav>li>a:hover{
                color: #ccc;
            }
            .navbar-default .navbar-brand {
                color: #ccc;
            }
        </style>
         <marquee style="color: white"> <span style="background: green"></span>  Welcome to premier POS for more details and features contact 0750857888 </marquee>
    </head>
    
    
    
    
    
    

    <body>
        <div style="color: white"> @include('layouts.partials.home_header')
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('layouts.partials.javascripts')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    @yield('javascript')</div>
       
     </body>
    
    @extends('body')
    
    
     	
   
    
</html>
