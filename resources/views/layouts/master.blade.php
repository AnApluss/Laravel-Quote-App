<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">  -->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
        @yield('styles')
    </head>
    <body>
       <div class="main">
           @yield('content')
       </div>
    </body>
</html>