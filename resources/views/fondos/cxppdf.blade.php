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

        <div style="margin-top:30px;text-align:center">
            <p style="font-weight:bold">Cuentas por pagar</p>
        </div>

    </header>

    <div class="Content_tabla_pdf">

        <table>
            <tr>
                <th style="min-width:120px">Servicio o Proveedor</th>
                <th style="min-width:120px">Total Facturado</th>
                <th style="min-width:120px">Total Pagado</th>
                <th style="min-width:120px">Pendiente de Pago</th>
            </tr>

            @foreach ($temps as $temp)
            @php
            $total = $temp->facturado - $temp->pagado;
            $totalg = $totalg + $total;
            @endphp
            @if($total > 0)
            <tr>
                <td>{{$temp->servicio}}</td>
                <td style="text-align:right">Bs. {{ number_format($temp->facturado, 2, ",", ".")}}</td>
                <td style="text-align:right">Bs. {{ number_format($temp->pagado, 2, ",", ".")}}</td>
                <td style="text-align:right;font-weight:bold">Bs. {{ number_format($total, 2, ",", ".")}}</td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:right;font-weight:bold;background-color:#2f5301;color:white">Total por Pagar:</td>
                <td style="text-align:right;font-weight:bold;background-color:#2f5301;color:white">Bs. {{ number_format($totalg, 2, ",", ".")}}</td>

            </tr>
        </table>
    </div>

    <footer style="font-weight:bold;font-size:10px;color:#505050;text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>