@extends('layouts.plantilla')

@section('title', 'Recibo de Cobro')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/dist1.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>RECIBO DE COBRO</h1>
        </div>

        <div class="Content_recibocdm">

            <div class="recibocdm">

                <div class="cabecera_recibocdm">
                    <div>
                        <h3 style="color: #2b5f00">ASOMAVILLA</h3>
                        <p style="font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
                        <p>asomavilla2009@gmail.com</p>
                        <p>J-30349217-7</p>
                    </div>

                    <div>
                        <h3>información del Propietario</h3>
                        <p>Propietario: {{ $users->name }}</p>
                        <p>Cédula Id.: {{ $users->ci }}</p>
                        <p>Casa: {{ $users->calle }}-{{ $users->casa }}</p>
                    </div>


                    <div>
                        @php
                        setlocale(LC_TIME,"es_ES");
                        @endphp
                        <h3> FC#{{ date('m-Y', strtotime($factura->periodo)) }} </h3>
                        <p>Fecha: {{ date('d-m-Y', strtotime($factura->fecha)) }}</p>
                        <p>Periodo: {{ strftime("%B %Y", strtotime( $factura->periodo )) }}</p>
                        <p style="font-weight:bold">TASA USD($): {{ number_format($factura->tasa, 2, ',', '.') }}</p>
                        <p style="font-weight:bold">Alícuota: {{ number_format($ctasc->alicuota, 2, ',', '.') }}</p>
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
                </div>
            </div>
            
            <div class="flex_center_center">
                <form action="{{route('create-pdfrecobro', $ctasc)}}" method="get" target="_blank">
                    @csrf
                    <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32" title="Imprimir"></button>
                </form>
            </div>

        </div>
    </div>

</main>
@endsection