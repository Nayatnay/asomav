@extends('layouts.plantilla')

@section('title', 'Factura Cierre')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/dist1.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>RECIBO CDM</h1>
        </div>

        <div class="Content_recibocdm">

            <div class="recibocdm">

                <div class="avisocdm">

                    @php
                    setlocale(LC_TIME,"es_ES");
                    @endphp
                    <h3>Cerrar el mes: {{ strftime("%B %Y", strtotime( $factura->periodo )) }}</h3> <br>
                    <p>Antes de cerrar verifique que haya incluido todas las facturas de proveedor recibidas en el mes.</p>
                    <p>Asegúrese de haber cargado los gastos generados de manera individual por propietario.</p>
                </div>

                <div class="cabecera_recibocdm">
                    <div>
                        <h3 style="color: #2b5f00">ASOMAVILLA</h3>
                        <p style="font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
                        <p>asomavilla2009@gmail.com</p>
                        <p>J-30349217-7</p>
                    </div>
                    <div>
                        <h3> FC#{{ date('m-Y', strtotime($factura->periodo)) }} </h3>
                        <p>Fecha: {{ date('d-m-Y', strtotime($factura->fecha)) }}</p>
                        <p>Periodo: {{ strftime("%B %Y", strtotime( $factura->periodo )) }}</p>
                        <p style="font-weight:bold">TASA USD($): {{ number_format($factura->tasa, 2, ',', '.') }}</p>
                        <p style="font-weight:bold">Alícuota: {{ number_format($alicuota, 2, ',', '.') }}</p>
                    </div>
                </div>

                <div class="cuerpo_recibocdm">

                    <div class="content_table_recibocdm">
                        <table>

                            <tr style="text-align:left">
                                <th style="width: 70%;min-width:250px">Detalle</th>
                                <th style="width: 15%;min-width:100px">Monto</th>
                                <th style="width: 15%;min-width:100px">Cuota Parte</th>

                            </tr>

                            @php
                            $total=0;
                            $totalgeneral=0;
                            $totcuotap=0;
                            $control = 0;
                            @endphp

                            @foreach ($fdetalles as $fdetalle)

                            @php
                            $cuotaparte = $fdetalle->monto * ($alicuota / 100);
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

                            @if ($fdetalle->gasto->id == 1)
                            @php
                            $control=1;
                            @endphp
                            @endif

                            @endforeach

                            @php

                            $totalgeneral = $total;

                            @endphp

                            <!-- reserva -->

                            @if ($control <> 1)
                                @php
                                $cuotapartereserv = $montoreser * ($alicuota / 100);
                                @endphp
                                <tr>
                                    <td style="width: 70%">Fondo de Reserva</td>
                                    <td style="text-align:right;width: 15%">Bs. {{ number_format($montoreser, 2, ",", ".")}}</td>
                                    <td style="text-align:right;width: 15%">Bs. {{ number_format($cuotapartereserv, 2, ",", ".")}}</td>
                                </tr>
                                @php
                                $total = $total + $montoreser;
                                $totcuotap = $totcuotap + $cuotapartereserv;
                                @endphp
                                @endif
                                <!-- FIN reserva -->

                                @php

                                $totalgeneral = $total;
                                
                                @endphp

                                <tr>
                                    <td style="padding-left:20px;width: 70%;height:40px">TOTAL GASTOS COMUNES</td>
                                    <td style="font-weight:bold;text-align:right;width: 15%">Bs. {{ number_format($total, 2, ',', '.') }} </td>
                                    <td style="font-weight:bold;text-align:right;width: 15%">Bs. {{ number_format($totcuotap, 2, ',', '.') }} </td>
                                </tr>

                                <tr>
                                    <td style="width:70%;font-weight:bold">Gastos no comunes</td>
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
                                    <td style="font-weight:bold;width: 15%;text-align:right"> Bs. {{ number_format($totalgeneral, 2, ',', '.') }} </td>
                                    <td style="font-weight:bold;width: 15%;text-align:right"> Bs. {{ number_format($totcuotap, 2, ',', '.') }} </td>
                                </tr>

                                @php
                                $totaldivisa = $totalgeneral / $factura->tasa;
                                $cuotaparte = $totaldivisa * $alicuota / 100;
                                @endphp

                                <tr>
                                    <td style="width: 70%;padding-left:20px;height:30px">TOTAL CDM (USD$) </td>
                                    <td style="font-weight:bold;width: 15%;text-align:right">$ {{ number_format($totaldivisa, 2, ',', '.') }} </td>
                                    <td style="font-weight:bold;width: 15%;text-align:right">$ {{ number_format($cuotaparte, 2, ',', '.') }} </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="encerrar">
                <a href="{{route('cerrar-factura', $factura)}}">Cerrar</a>
            </div>

            <div class="estado">
                @if (session('info'))
                <p>No procede. Estado Actual: CERRADO 🔐</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection