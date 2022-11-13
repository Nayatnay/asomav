@extends('layouts.plantilla')

@section('title', 'Recibos Pendientes Usuario')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>RECIBOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h3> {{ $usuario->name }} {{$usuario->calle}}-{{$usuario->casa}} </h3>
                </div>
                
            </div>

            <div class="Content_tabla_white">
                <table id="tabladeuda">
                    <thead>
                        <tr>
                            <th style="min-width:80px">Recibo</th>
                            <th style="min-width:120px">Cuota Parte</th>
                            <th style="min-width:120px">Gasto Individual</th>
                            <th style="min-width:120px">Deuda</th>
                            <th style="min-width:120px">Condición</th>
                            <th style="min-width:20px">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($estatus <> NULL)
                            <tr>
                                <td>D.A.</td>
                                <td>---</td>
                                <td>---</td>
                                <td style="text-align:right;font-weight:bold">{{number_format($cargo, 2, ",", ".")}}</td>

                                <td style="text-align:center;color:blue;font-size:10px;font-weight:bold">Pendiente Conciliación</td>

                                <td style="text-align:center;color:blue;font-size:10px;font-weight:bold">REF. {{$estatus}}</td>
                                
                            </tr>
                            @endif


                            @foreach ($ctasc as $cuentas)
                            <tr>
                                @php
                                $total = $cuentas->cuotap + $cuentas->nocomunes;
                                @endphp

                                <td>{{date('m-Y', strtotime($cuentas->factura->periodo))}}</td>
                                <td style="text-align:right">Bs. {{number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                                <td style="text-align:right">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                                <td style="text-align:right;font-weight:bold">Bs. {{ number_format($total, 2, ",", ".")}}</td>

                                @if ($cuentas->estatus == NULL)
                                <td style="text-align:center;color:blue;font-size:10px;font-weight:bold">{{$cuentas->estatus}}</td>
                                @elseif ($cuentas->estatus == "Pagado")
                                <td style="text-align:center;color:blue;font-size:10px;font-weight:bold">{{$cuentas->estatus}}</td>
                                @else
                                <td style="text-align:center;color:blue;font-size:10px;font-weight:bold">Pendiente Conciliación: {{$cuentas->estatus}}</td>
                                @endif

                                <td><a href="{{route('ver-recobro', $cuentas)}}">Ver</a></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection