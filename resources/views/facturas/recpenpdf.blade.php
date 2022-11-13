<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos Pendientes</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
</head>

<body style="background-color:white" class="docum">

    <header style="text-align:center">
        <img src="{!! asset('img/logo2.png') !!}" alt="logo Asomavilla" width="64">
        <h2>ASOMAVILLA</h2>
        <p style="color:#505050; font-weight:bold;font-size:12px">Recibos Pendientes</p><br>
        <p style="font-weight:bold">Listado de Cobros Pendientes</p>
    </header>
    <div class="Content_tabla_pdf">
        <table>
            <tr>
                <th style="width:30%;text-align:left">Propietario</th>
                <th style="width:10%">Recibo</th>
                <th style="width:20%">Cuota Parte</th>
                <th style="width:20%">Gasto Individual</th>
                <th style="width:20%">Deuda</th>
            </tr>

            @foreach ($ctasc as $cuentas)
            <tr>

                @php
                $total = $cuentas->cuotap + $cuentas->nocomunes;
                $totalg = $totalg + $total;
                @endphp

                <td style="text-align:left">{{$cuentas->user->name}}</td>
                <td>{{ date('m-Y', strtotime( $cuentas->factura->periodo )) }}</td>
                <td style="text-align:right">Bs. {{ number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                <td style="text-align:right">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                <td style="text-align:right">Bs. {{ number_format($total, 2, ",", ".")}}</td>

            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total por cobrar: </td>
                <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>
            </tr>
        </table>
    </div>
    <footer style="position:fixed;top:750pt;left:0;right:0;font-weight:bold;font-size:12px;color:#505050;text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>