<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <title> @yield('title') </title>

        <!-- Styles -->
         <style>
            .fixed-top{
                position: fixed;
                background-color:#186bf6;              
            }
            @media (max-width: 767px) {
            .navbar-collapse
                {
                    background-color:#186bf6;
                }
            }
         </style>
    </head>
    <body>
	<!-- navbar -->
    @extends('layouts.nav-bar')
    @section('title', 'Home')
    @section('content')
        <!-- <div class="pt-5">         // Some Content for the Home page        </div> -->
    @endsection    
    </body>
</html> 