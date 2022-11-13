@extends('layouts.plantilla')

@section('title', 'Informe de finanzas Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/finanzc.png') !!}" alt="logo finanzas" width="72">
            <h1>FINANZAS</h1>
        </div>

        <div class="content_ft">
            <div class="saldos" style="display:flex;margin:10px">
                <div style="color:#325000;margin:0px 10px" class="flex_center_right">
                    <div class="flex_center_center_column">
                        <p style="color:#505050;font-size:10px;font-weight:bold">FONDO DE RESERVA</p>
                        <h2>{{number_format($totalr, 2, ",", ".")}}</h2>
                        <p style="color:#505050;font-size:11px;font-weight:bold">B o l í v a r e s</p>
                    </div>
                </div>

                <div style="margin:0px 10px" class="flex_center_right">
                    <div class="flex_center_center_column">
                        <p style="font-size:10px;font-weight:bold">SALDO EN CUENTA</p>
                        <h2>{{number_format($total, 2, ",", ".")}}</h2>
                        <p style="font-size:11px;font-weight:bold">B o l í v a r e s</p>
                    </div>
                </div>
            </div>

            <div class="propa" style="padding:5px;border:2px solid white;border-radius:3px;margin:5px 2px;font-size:14px;font-weight:bold">
                <div>
                    <p>Gastos del Mes</p>
                </div>
                @can('usuarios.index')
                <div style="margin:0px 10px">
                    <form action="{{route('fondos-gastosmes-pdf')}}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="24"></button>
                    </form>
                </div>
                @endcan
            </div>
            <div class="table-responsive" style="height: 200px">

                <table class="tabla">
                    <tr class="table_header">
                        <th class="fecha">Fecha</th>
                        <th class="descripcion">Descripcion</th>
                        <th class="monto">Monto</th>
                    </tr>

                    @if(count($fondos)<=0) <tr>
                        <td colspan="9" class="negritas">No hay resultados</td>
                        </tr>
                        @else
                        @foreach ($fondos as $fondo)
                        @if (date('m', strtotime( $fondo->fecha)) == now()->month)
                        @php
                        $totald = $totald + $fondo->abono;
                        @endphp
                        <tr class="table_item">
                            <td class="t_i">{{date('d-m-Y', strtotime( $fondo->fecha))}}</td>
                            <td class="t_i">{{ $fondo->descripcion }}</td>
                            <td class="t_i" style="text-align:right;padding-right:5px">Bs. {{ number_format($fondo->abono, 2, ",", ".") }}</td>
                        </tr>
                        @endif
                        @endforeach


                        @endif

                        <tr class="table_item">
                            <td class="t_i"> </td>
                            <td class="t_i"> </td>
                            <td class="t_i" style="font-weight:bold;text-align:right;padding-right:5px">Bs. {{ number_format($totald, 2, ",", ".") }}</td>
                        </tr>
                </table>
            </div>

            <div class="propa" style="padding:5px;border:2px solid white;border-radius:3px;margin:5px 2px;font-size:14px;font-weight:bold">
                <div>
                    <p>Detalle de Morosidad (Recibos)</p>
                </div>
                @can('usuarios.index')
                <div style="margin:0px 10px">
                    <form action="{{route('fondos-morosos-pdf')}}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="24"></button>
                    </form>
                </div>
                @endcan
            </div>
            
            <div class="table-responsive" style="height: 200px">
                <table class="tabla">
                    <tr class="table_header">
                        <th style="width:35%;min-width:200px;text-align:left;padding-left:10px">Propietario</th>
                        <th style="width:10%;min-width:80px">Recibo</th>
                        <th style="width:15%;min-width:120px">Cuota Parte</th>
                        <th style="width:15%;min-width:120px">Gasto Individual</th>
                        <th style="width:15%;min-width:120px">Deuda</th>

                    </tr>

                    @foreach ($ctasc as $cuentas)
                    <tr class="table_item">
                        @php
                        $total = $cuentas->cuotap + $cuentas->nocomunes;
                        $totalg = $totalg + $total;
                        @endphp
                        <td style="text-align:left;padding-left:10px">{{$cuentas->user->name}}</td>
                        <td>{{ date('m-Y', strtotime( $cuentas->factura->periodo ))}}</td>
                        <td style="text-align:right;padding-right:5px">Bs. {{ number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                        <td style="text-align:right;padding-right:5px">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                        <td style="text-align:right;padding-right:5px">Bs. {{ number_format($total, 2, ",", ".")}}</td>

                    </tr>
                    @endforeach

                    <tr class="table_item">
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Morosidad Recibos: </td>
                        <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>
                    </tr>

                </table>
            </div>

            <div class="propa" style="padding:5px;border:2px solid white;border-radius:3px;margin:5px 2px;font-size:14px;font-weight:bold">
                <div>
                    <p>Morosidad Deuda Anterior</p>
                </div>
                @can('usuarios.index')
                <div style="margin:0px 10px">
                    <form action="{{route('fondos-deudante-pdf')}}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="24"></button>
                    </form>
                </div>
                @endcan
            </div>
            
            @php
            $totalg = 0;
            @endphp
            <div class="table-responsive" style="height: 200px">
                <table class="tabla">
                    <tr class="table_header">
                        <th style="width:35%;min-width:200px;text-align:left;padding-left:10px">Propietario</th>
                        <th style="width:15%;min-width:120px">Deuda</th>
                    </tr>

                    @foreach ($saldo as $deuda)
                    @php
                    $totalg = $totalg + $deuda->deuda;
                    @endphp
                    <tr class="table_item">
                        <td style="text-align:left;padding-left:10px">{{$deuda->user->name}}</td>
                        <td style="text-align:right;padding-right:5px">Bs. {{ number_format($deuda->deuda, 2, ",", ".")}}</td>
                    </tr>
                    @endforeach

                    <tr class="table_item">

                        <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Morosidad D.A.: </td>
                        <td style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>
                    </tr>

                </table>
            </div>

        </div>
    </div>
</main>
@endsection