<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fondos</title>
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

        <div style="margin-top:30px;text-align:center">
            <p style="font-weight:bold">Movimiento de Fondos</p>
        </div>

    </header>

    <div class="Content_tabla_pdf">

        <table class="tabla">
            <tr class="table_header">
                <th class="fecha">Fecha</th>
                <th class="descripcion">Descripcion</th>
                <th class="Cargo">Cargo</th>
                <th class="abono">Abono</th>
                <th class="saldo">Saldo</th>
            </tr>

            @foreach ($fondos as $fondo)
            @php
            $total = $total + $fondo->cargo - $fondo->abono;
            @endphp
            <tr class="table_item">
                <td class="t_i">{{ date('d-m-Y', strtotime( $fondo->fecha )) }}</td>
                <td class="t_i"  style="text-align:left;padding-left:5px">{{ $fondo->descripcion }}</td>
                <td class="t_i" style="text-align:right;padding-right:5px">{{ number_format($fondo->cargo, 2, ",", ".") }}</td>
                <td class="t_i" style="text-align:right;padding-right:5px">{{ number_format($fondo->abono, 2, ",", ".") }}</td>
                <td class="t_i" style="text-align:right;padding-right:5px">{{ number_format($total, 2, ",", ".") }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <footer style="font-weight:bold;font-size:10px;color:#505050;text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>