<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
</head>

<body style="background-color:white">

    <header>
        <div class="flex_center_beetw">
            <div>
                <img src="{!! asset('img/logaso.png') !!}" alt="logo Arbol" width="192">
                <p style="font-size:9px;font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
            </div>
            <div style="font-size:10px; text-align:left;margin-top:20px">
                <p style="font-weight:bold;font-size:16px">Estado de cuenta</p>
                <p>{{ $usuario->name }}</p>
                <p>{{ $usuario->ci }}</p>
                <p>Casa {{ $usuario->calle }}-{{ $usuario->casa }}</p>
            </div>
        </div>
        <div style="text-align:center">
            <p style="font-weight:bold">Movimientos</p>
        </div>


    </header>
    <div class="Content_tabla_pdf">
        <table id="tabladeuda">
            <thead>
                <tr>
                    <th style="min-width:80px">Fecha</th>
                    <th style="min-width:80px">Recibo</th>
                    <th style="min-width:80px">Pago</th>
                    <th style="min-width:80px">Saldo</th>
                    <th style="min-width:200px">Detalle</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($movimiento as $movi)
                <tr>
                    @php
                    $total = $total + $movi->cargo - $movi->abono;
                    @endphp

                    <td>{{date('d-m-Y', strtotime($movi->fecha))}}</td>
                    <td style="text-align:right">{{number_format($movi->cargo, 2, ",", ".")}}</td>
                    <td style="text-align:right">{{number_format($movi->abono, 2, ",", ".")}}</td>
                    <td style="text-align:right">{{number_format($total, 2, ",", ".")}}</td>
                    <td style="text-align:center">{{$movi->descripcion}}</td>
                </tr>
                @endforeach

                <tr>
                    <td>{{Carbon\Carbon::now()->format('d-m-Y')}}</td>
                    <td></td>
                    <td style="text-align:right;font-weight:bold">Saldo Final:</td>
                    <td style="text-align:right;font-weight:bold">{{number_format($total, 2, ",", ".")}}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer style="font-weight:bold;font-size:10px;color:#505050; text-align:center">
        <p>Administración de Asomavilla. RIF. J-30349217-7.</p>
    </footer>

</body>

</html>