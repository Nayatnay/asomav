@extends('layouts.plantilla')

@section('title', 'Estado Cuenta Usuario')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/edocta.png') !!}" alt="logo Estado Cuenta" width="72">
            <h1>MOVIMIENTOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h3> {{ $usuario->name }} {{$usuario->calle}}-{{$usuario->casa}} </h3>
                </div>
                <div style="margin:0px 10px">
                    <form action="{{route('usuarios-edoctau-pdf', $usuario)}}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32"></button>
                    </form>
                </div>
            </div>

            <div class="Content_tabla_white">
                <table id="tabladeuda">
                    <thead>


                        <tr>
                            <th style="min-width:100px">Fecha</th>
                            <th style="min-width:120px">Recibo</th>
                            <th style="min-width:120px">Pago</th>
                            <th style="min-width:120px">Saldo</th>
                            <th style="min-width:120px">Detalle</th>

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
        </div>
    </div>
</main>
@endsection