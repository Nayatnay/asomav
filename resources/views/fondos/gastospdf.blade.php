<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Gastos</title>
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
            <p style="font-weight:bold">Gastos</p>
        </div>

    </header>

    <div class="Content_tabla_pdf">
        <table class="tabla">
            <tr class="table_header">
                <th class="fecha">Fecha</th>
                <th class="descripcion">Descripcion</th>
                <th class="monto">Monto</th>
            </tr>

            @if(count($fondos)<=0) <tr>
                <td colspan="9" class="negritas">No hay resultados</td>
                </tr>
                @else
                @foreach ($fondos as $fondo)
                @if (date('m', strtotime( $fondo->fecha)) == now()->month)
                @php
                $total = $total + $fondo->abono;
                @endphp
                <tr class="table_item">
                    <td class="t_i">{{date('d-m-Y', strtotime( $fondo->fecha))}}</td>
                    <td class="t_i">{{ $fondo->descripcion }}</td>
                    <td class="t_i" style="text-align:right;padding-right:5px">Bs. {{ number_format($fondo->abono, 2, ",", ".") }}</td>
                </tr>
                @endif
                @endforeach


                @endif

                <tr class="table_item">
                    <td class="t_i"> </td>
                    <td class="t_i"> </td>
                    <td class="t_i" style="font-weight:bold;text-align:right;padding-right:5px">Bs. {{ number_format($total, 2, ",", ".") }}</td>
                </tr>
        </table>
    </div>


    <footer style="font-weight:bold;font-size:12px;color:#505050">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>