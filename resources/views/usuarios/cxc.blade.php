@extends('layouts.plantilla')

@section('title', 'Recibos Pendientes Propietario')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>POR COBRAR</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h3>{{$usuario->name}} {{$usuario->calle}}-{{$usuario->casa}} </h3>
                </div>
                @php
                $usuario = $usuario->id;
                @endphp
                <div class="saldo">                    
                                      
                     @if ($saldt <> 0)
                     <h3> Deuda Anterior: Bs. {{number_format($saldt, 2, ",", ".")}}</h3></a>
                     <a href="{{route('saldos.edit', $usuario)}}"> Modificar Aquí </a>
                     @endif
                                       
                </div>
                
            </div>

            <div class="Content_tabla_white">
                <table>

                    <tr>
                        <th style="min-width:80px">Recibo</th>
                        <th style="min-width:120px">Cuota Parte</th>
                        <th style="min-width:120px">Gasto Individual</th>
                        <th style="min-width:120px">Deuda</th>                        
                    </tr>

                    @foreach ($ctasc as $cuentas)
                    <tr>
                        @php
                        $total = $cuentas->cuotap + $cuentas->nocomunes;
                        @endphp
                    
                        <td>{{$cuentas->factura->periodo}}</td>
                        <td style="text-align:right">Bs. {{ number_format($cuentas->cuotap, 2, ",", ".")}}</td>
                        <td style="text-align:right">Bs. {{ number_format($cuentas->nocomunes, 2, ",", ".")}}</td>
                        <td style="text-align:right;font-weight:bold">Bs. {{ number_format($total, 2, ",", ".")}}</td>
                        
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</main>
@endsection