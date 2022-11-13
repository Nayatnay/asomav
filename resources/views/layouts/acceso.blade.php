<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" cont>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Asomavilla</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/acceso.css') !!}">
    <script src="../js/master.js" defer></script>
</head>

<body>

    @include('layouts.partials.header')

    <main class="cuerpo">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>

</html>