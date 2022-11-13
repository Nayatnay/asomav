@extends('layouts.plantilla')

@section('title', 'Cuentas Incobrables')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/incob.png') !!}" alt="logo incobrables" width="72">
            <h1>C. INCOBRABLES</h1>
        </div>

        <div class="content_ft">

            <div style="margin:0px 10px;text-align:right">
                <form action="{{route('ctasinc-pdf')}}" method="get" target="_blank">
                    @csrf
                    <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32"></button>
                </form>
            </div>

            <div class="Content_tabla_white" style="font-size:12px">
                <table>

                    <tr>
                        <th style="min-width:100px;font-size:12px">Fecha</th>
                        <th style="min-width:280px;font-size:12px">Propietario</th>
                        <th style="min-width:200px;font-size:12px">Recibos sin cancelar</th>
                        <th style="min-width:100px;font-size:12px;text-align:right">G. Comunes</th>
                        <th style="min-width:100px;font-size:12px;text-align:right">G. Individuales</th>
                        <th style="min-width:100px;font-size:12px;text-align:right">Total Pérdida</th>

                    </tr>

                    @foreach ($ctasincob as $cuentas)
                    <tr>
                        @php
                        $total = $cuentas->cuotap + $cuentas->nocomunes;
                        $totalg = $totalg + $total;
                        @endphp
                        <td>{{date('d-m-Y', strtotime( $cuentas->fecha)) }}</td>
                        <td style="text-align:left">{{$cuentas->name}} {{$cuentas->ci}} | {{$cuentas->email}} {{$cuentas->telf}} | Casa {{$cuentas->calle}}-{{$cuentas->casa}}</td>
                        <td>{{$cuentas->descripcion}}</td>
                        <td style="text-align:right">Bs. {{ number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                        <td style="text-align:right">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                        <td style="text-align:right">Bs. {{ number_format($total, 2, ",", ".")}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td style="font-weight:bold;">{{Carbon\Carbon::now()->format('d-m-Y')}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Total Pérdidas: </td>
                        <td class="t_i" style="font-weight:bold;text-align:right;background-color:lightgrey;padding-right:5px">Bs. {{ number_format($totalg, 2, ",", ".") }}</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection