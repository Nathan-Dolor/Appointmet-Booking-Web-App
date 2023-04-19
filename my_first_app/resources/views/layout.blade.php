<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if(Route::currentRouteName() != 'welcome')
    <style>
      body{
        background-color: #e3f2fd;
        
      }
    </style>
    @else
    <style>
      body{
        background-color: #A4D6F0;
      }
    </style>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.0.1/build/global/luxon.min.js"></script>
  </head>
  <body>   
    @if(Route::currentRouteName() != 'welcome')
    @include('include.header')
    @endif 
    @yield('content')
    
    <script>
      $(document).ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        },5000);
    });
    </script>

    <!-- @include('include.footer') -->
    
  </body>
  
  <script>document.getElementById("currentYear").innerHTML = new Date().getFullYear()</script>
</html>