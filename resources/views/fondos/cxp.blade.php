@extends('layouts.plantilla')

@section('title', 'Finanzas Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo finanzas" width="72">
            <h1>CUENTAS POR PAGAR</h1>
        </div>

        <div class="content_ft">

            <div class="saldos" style="display:flex">

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
                        <h2>{{number_format($totalf, 2, ",", ".")}}</h2>
                        <p style="font-size:11px;font-weight:bold">B o l í v a r e s</p>
                    </div>
                </div>


            </div>


            <div class="Content_tabla_white">
                <table>

                    <tr>
                        <th style="min-width:200px">Servicio o Proveedor</th>
                        <th style="min-width:120px">Total Facturado</th>
                        <th style="min-width:120px">Total Pagado</th>
                        <th style="min-width:120px">Pendiente de Pago</th>
                        <th style="min-width:20px">Pagar</th>
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
                        <td><a href="{{route('fondos-pagos', $temp)}}"><img src="{!! asset('img/check1.png') !!}" class="botonverde" alt="" width="16" title="Pagar"></a></td>
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
            <div style="margin:0px 10px;text-align:right">
            <form action="{{route('gastos-cxpdf')}}" method="get" target="_blank">
                @csrf
                <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32"></button>
            </form>
        </div>
        </div>

    </div>
</main>

@endsection