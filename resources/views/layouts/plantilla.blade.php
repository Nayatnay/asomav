<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
    <script src="{{ asset('js/ppal.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>

    @include('layouts.partials.hppal')

    @yield('content')

    @include('layouts.partials.footer')

    <!-- volver a la misma posicion al recargar la pagina ***************-->

    <script>
        window.onload = function() {
            var pos = window.name || 0;
            window.scrollTo(0, pos);
        }
        window.onunload = function() {
            window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
        }
    </script>

    @yield('js')

</body>

</html>