@extends('layouts.plantilla')

@section('title', 'Recibos de Cobro')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/dist1.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>RECIBOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Recibos Pendientes</h2>
                </div>
                <div class="flex_center_center">
                    <div id="envios">
                        <p>enviando...</p>
                    </div>

                    @if (session('info'))
                    <div class="estado">
                        <p>Correo Masivo Enviado con éxito 👌</p>
                    </div>
                    @endif

                    <div style="margin:0px 10px">
                        <form action="{{route('create-pdfrecpen')}}" method="get" target="_blank">
                            @csrf
                            <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32"></button>
                        </form>
                    </div>
                    <div style="margin:0px 10px">
                        <form action="{{route('envios')}}" method="get" onclick="ani()">
                            @csrf
                            <button type="submit" class="botonverde" title="Enviar Notificacion de Cobro"><img src="{!! asset('img/correo.png') !!}" alt="logo correo" width="32"></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="Content_tabla_white">
                <table>

                    <tr>
                        <th style="width:40%;min-width:200px;text-align:left">Propietario</th>
                        <th style="width:10%;min-width:80px">Recibo</th>
                        <th style="width:15%;min-width:120px">Cuota Parte</th>
                        <th style="width:15%;min-width:120px">Gasto Individual</th>
                        <th style="width:15%;min-width:120px">Deuda</th>
                        <th style="width:5%">Opc</th>
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
                        <td style="text-align:center"><a href="{{route('ver-recobro', $cuentas)}}">Ver</a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Morosidad: </td>
                        <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection