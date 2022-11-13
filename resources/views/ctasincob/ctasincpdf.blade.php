<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Cuentas Incobrables</title>
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
        <div style="text-align:center">
            <p style="font-weight:bold">Cuentas Incobrables</p>
        </div>
    </header>

    <div class="Content_tabla_pdf">
        <table>

            <tr>
                <th style="min-width:70px;font-size:12px">Fecha</th>
                <th style="min-width:180px;font-size:12px">Propietario</th>
                <th style="min-width:100px;font-size:12px">Recibos sin cancelar</th>
                <th style="min-width:70px;font-size:12px;text-align:right">Gastos C.</th>
                <th style="min-width:70px;font-size:12px;text-align:right">Gastos I.</th>
                <th style="min-width:70px;font-size:12px;text-align:right">Total Pérdida</th>

            </tr>

            @foreach ($ctasincob as $cuentas)
            <tr>
                @php
                $total = $cuentas->cuotap + $cuentas->nocomunes;
                $totalg = $totalg + $total;
                @endphp
                <td>{{date('d-m-Y', strtotime( $cuentas->fecha)) }}</td>
                <td style="text-align:left">{{$cuentas->name}} {{$cuentas->ci}} | {{$cuentas->email}} {{$cuentas->telf}} | Casa {{$cuentas->calle}}-{{$cuentas->casa}}</td>
                <td>{{$cuentas->descripcion}}</td>
                <td style="text-align:right">Bs. {{ number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                <td style="text-align:right">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                <td style="text-align:right">Bs. {{ number_format($total, 2, ",", ".")}}</td>

            </tr>
            @endforeach
            <tr>
                <td style="font-weight:bold;">{{Carbon\Carbon::now()->format('d-m-Y')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Pérdidas: </td>
                <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>

            </tr>
        </table>
    </div>

    <footer style="font-weight:bold;font-size:10px;color:#505050;text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>