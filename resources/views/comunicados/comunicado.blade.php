<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicado Asomavilla</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
</head>

<body style="background-color:white;padding:60px 80px">

    <header style="text-align:center">

        <div class="flex_center_center">
            <div style="text-align:left">
                <img src="{!! asset('img/logaso.png') !!}" alt="logo Arbol" width="256">
                <p style="font-size:12px;font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
            </div>
            <div style="margin-top:30px">
                <h3>COMUNICADO</h3>
                <p style="color:#124e34; font-weight:bold;font-size:12px">Nº {{$comunicado->id}}-{{$comunicado->fecha}}</p>
            <div style="font-weight:bold;font-size:14px;margin-top:30px;text-align:left">
                <span>Asunto: </span>
                <span style="font-weight:normal">{{$comunicado->encabezado}}</span>
            </div>    
            </div>
        </div>
    </header>

    <div class="wrapper">
        <textarea id="cuerpo" name="cuerpo" style="margin-top:20px;border:none;width:96%;height:600px;font-size:14px;font-family: system-ui, system-ui, sans-serif;font-weight:lighter">{{$comunicado->cuerpo}}</textarea>
    </div>

    <footer style="position:fixed;top:750pt;left:0;right:0;font-weight:bold;font-size:12px;text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

    <script>
        window.onload = function() {
            const cuerpo = document.querySelector("textarea")
            let scHeight = cuerpo.scrollHeight;
            cuerpo.style.height = scHeight + 'px';
        }
    </script>


</body>

</html>