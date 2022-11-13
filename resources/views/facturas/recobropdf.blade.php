<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos de Cobro</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/ppal.css') !!}">
</head>

<body style="background-color:white">

    <div class="">

        <div class="recibocdm">

            <div class="cabecera_recibocdm">
                <div>
                    <img src="{!! asset('img/logaso.png') !!}" alt="logo Arbol" width="192" class="">
                </div>
                            
                <div style="font-size:12px">
                    @php
                    setlocale(LC_TIME,"es_ES");
                    @endphp
                    <h3> RECIBO DE COBRO FC#{{ date('m-Y', strtotime($factura->periodo)) }} </h3>                
                    <span>Fecha: {{ date('d-m-Y', strtotime($factura->fecha)) }}</span>
                    <span>Periodo: {{ strftime("%B %Y", strtotime( $factura->periodo )) }}</span>
                    <span style="font-weight:bold">TASA USD($): {{ number_format($factura->tasa, 2, ',', '.') }}</span>
                    <span style="font-weight:bold">Alícuota: {{ number_format($ctasc->alicuota, 2, ',', '.') }}</span>
                </div>

                <div style="font-size:12px">
                    <span style="font-weight:bold">Propietario:</span>
                    <span>{{ $users->name }}</span>
                    <span style="font-weight:bold">Cédula Id.:</span>
                    <span>{{ $users->ci }}</span>
                    <span style="font-weight:bold">Casa:</span>
                    <span>{{ $users->calle }}-{{ $users->casa }}</span>
                </div>
            </div>

            <div class="cuerpo_recibocdm" style="font-size:12px">

                <div class="content_table_recibocdm" style="margin:0px">
                    <table>
                        <tr>
                            <th style="width: 70%;min-width:250px;text-align:left">Detalle</th>
                            <th style="width: 15%;min-width:100px">Monto</th>
                            <th style="width: 15%;min-width:100px">Cuota Parte</th>
                        </tr>

                        @php
                        $total=0;
                        $totalgeneral=0;
                        $totcuotap=0;
                        @endphp

                        @foreach ($fdetalles as $fdetalle)
                        @php
                        $cuotaparte = $fdetalle->monto * ($ctasc->alicuota / 100);
                        $totcuotap = $totcuotap + $cuotaparte;
                        @endphp
                        <tr>
                            <td style="width: 70%">{{$fdetalle->gasto->descripcion}}</td>
                            <td style="text-align:right;width: 15%">Bs. {{ number_format($fdetalle->monto, 2, ",", ".")}}</td>
                            <td style="text-align:right;width: 15%">Bs. {{ number_format($cuotaparte, 2, ",", ".")}}</td>
                            <td></td>
                            @php
                            $total += $fdetalle->monto;
                            @endphp
                        </tr>
                        @endforeach

                        @php
                        $totalgeneral = $total;
                        @endphp

                        <tr>
                            <td style="padding-left:20px;width: 70%;height:40px">TOTAL GASTOS COMUNES</td>
                            <td style="font-weight:bold;text-align:right;width: 15%">Bs. {{ number_format($total, 2, ',', '.') }} </td>
                            <td style="font-weight:bold;text-align:right;width: 15%">Bs. {{ number_format($totcuotap, 2, ',', '.') }} </td>
                        </tr>

                        <tr>
                            <td style="width:70%;font-weight:bold">Gastos Individuales</td>
                            <td style="width: 15%"></td>
                            <td style="width: 15%"></td>
                        </tr>

                        @php
                        $total=0;
                        @endphp

                        @foreach ($gnoc as $nocomun)
                        <tr>
                            <td style="width: 70%">{{$nocomun->descripcion}} / Propietario {{$nocomun->user->calle . '-' . $nocomun->user->casa}}</td>
                            <td style="text-align:right;width: 15%"></td>
                            <td style="text-align:right;width: 15%">Bs. {{ number_format($nocomun->monto, 2, ",", ".")}}</td>

                            @php
                            $total += $nocomun->monto;
                            $totcuotap= $totcuotap + $total;
                            @endphp

                        </tr>
                        @endforeach

                        <tr>
                            <td style="width: 70%;padding-left:20px;height:40px">TOTAL GASTOS NO COMUNES</td>
                            <td style="font-weight:bold;width: 15%;text-align:right"></td>
                            <td style="font-weight:bold;width: 15%;text-align:right"> Bs. {{ number_format($total, 2, ',', '.') }} </td>
                        </tr>

                        <tr>
                            <td style="width: 70%;padding-left:20px;height:30px">TOTAL RECIBO CDM</td>
                            <td style="font-weight:bold;width: 15%;text-align:right"></td>
                            <td style="font-weight:bold;width: 15%;text-align:right"> Bs. {{ number_format($totcuotap, 2, ',', '.') }} </td>
                        </tr>

                        @php
                        $totaldivisa = $totcuotap / $factura->tasa;
                        @endphp

                        <tr>
                            <td style="width: 70%;padding-left:20px;height:30px">TOTAL CDM ($) </td>
                            <td style="font-weight:bold;width: 15%;text-align:right"></td>
                            <td style="font-weight:bold;width: 15%;text-align:right">$ {{ number_format($totaldivisa, 2, ',', '.') }} </td>
                        </tr>
                    </table>
                </div>
                <p style="font-size:9px;text-align:right;font-weight:bold;color: #2b5f00;padding-right:15px">RECUERDE PAGAR ANTES DE FIN DE MES</p>
            </div>
            
        </div>
        
    </div>

</body>

</html>