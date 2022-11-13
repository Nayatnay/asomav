<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morosidad Deuda anterior</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
</head>

<body style="background-color:white" class="docum">

    <header>

        <div class="flex_center_beetw">
            <div>
                <img src="{!! asset('img/logaso.png') !!}" alt="logo Arbol" width="192">
                <p style="font-size:9px;font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
            </div>
        </div>

        <div style="margin-top:30px;">
            <p style="font-weight:bold">Morosidad Deuda Anterior</p>
        </div>

    </header>

    <div class="Content_tabla_pdf">
        <table class="tabla">
            <tr class="table_header">
                <th style="width:35%;min-width:200px;text-align:left;padding-left:10px">Propietario</th>
                <th style="width:15%;min-width:120px">Deuda</th>
            </tr>

            @foreach ($saldo as $deuda)
            @php
            $totalg = $totalg + $deuda->deuda;
            @endphp
            <tr class="table_item">
                <td style="text-align:left;padding-left:10px">{{$deuda->user->name}}</td>
                <td style="text-align:right;padding-right:5px">Bs. {{ number_format($deuda->deuda, 2, ",", ".")}}</td>
            </tr>
            @endforeach

            <tr class="table_item">

                <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Morosidad D.A.: </td>
                <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>
            </tr>

        </table>
    </div>

    <footer style="font-weight:bold;font-size:12px;color:#505050">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>