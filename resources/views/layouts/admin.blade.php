<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- API Token -->
    @auth
    <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endauth
    

    <title>admin panel / {{strtolower(config('app.name'))  }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/admin.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
   

</head>
    <body>
        <code>{{ session('message') }}</code>

       <div id="admin">
          
          
           
       </div>

      
    </body>
</html>
