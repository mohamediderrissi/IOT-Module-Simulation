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
        <nav class="navbar navbar-expand-lg fixed-top" style="height:60px;">
            <div class="container-fluid">
                    <a class="navbar-brand" href="https://webreathe.fr"><img style="height:30px; width:100px"  src="/images/logo.png"/></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><img style="height:30px; width:30px"  src="/images/navbar-icon.png"/></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item">
                                                <a style="color: #fdfdfe" class="nav-link " href="/dashboard">Dashboard</a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a style="color: #fdfdfe" class="nav-link " href="/create">Create New Module</a>
                                            </li>
                                            <li class="nav-item">
                                                <a style="color: #fdfdfe" class="nav-link " href="/simulate">Simulation</a>
                                            </li>
                                        </ul>
                    </div>
            </div>        
        </nav>
        
        <div class="pt-5">
            @yield('content')
        </div>
    </body>
</html> 