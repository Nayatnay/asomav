<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Asomavilla</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="">
    <script src="../js/master.js" defer></script>
</head>
<body>

    @include('layouts.partials.header')

    
        @yield('content')
    

    @include('layouts.partials.footer')
    
</body>
</html>