@extends('layouts.plantilla')

@section('title', 'Conciliaciones')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/conciliar.png') !!}" alt="logo conciliación" width="72">
            <h1>CONCILIACION</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h3>Pagos recibidos pendientes de conciliación</h3>
                </div>
            </div>


            <div class="Content_tabla_white">
                <table id="tabladeuda">
                    <thead>
                        <tr>

                            <th>Número de Referencia</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th style="min-width:20px">Conciliar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saldos as $saldo)
                        <tr>
                            <td style="color:blue;font-weight:bold;font-size:12px">{{$saldo->estatus}}</td>
                            <td>{{$saldo->descripcion}}</td>
                            <td>{{number_format($saldo->abono, 2, ",", ".")}}</td>
                            <td><a href="{{route('conciliar-deuda', $saldo)}}"><img src="{!! asset('img/check1.png') !!}" class="botonverde" alt="" width="16" title="Validar Conciliar"></a></td>
                        </tr>
                        @endforeach

                        @foreach ($pagos as $pago)
                        <tr>
                            <td style="color:blue;font-weight:bold;font-size:12px">{{$pago->num_operacion}}</td>
                            <td>{{$pago->operacion}}</td>
                            <td>{{number_format($pago->monto, 2, ",", ".")}}</td>
                            <td><a href="{{route('conciliar-pagos', $pago)}}"><img src="{!! asset('img/check1.png') !!}" class="botonverde" alt="" width="16" title="Validar Conciliar"></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection