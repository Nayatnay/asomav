@extends('layouts.plantilla')

@section('title', 'Facturas Edición')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/concil.png') !!}" alt="logo facturación" width="72">
            <h1>FACTURACION</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Editar Detalles</h2>

                </div>
                <div class="centbottom">
                    <div>
                        <span style="font-size:18px;font-weight:bold"> FC#{{ $factura->id }} </span>
                        <span style="font-size:12px;">Fecha: </span>
                        <span style="font-size:12px;font-weight:bold"> {{ date('d-m-Y', strtotime($factura->fecha)) }} </span>
                        <span style="font-size:12px;">Periodo: </span>
                        <span style="font-size:12px;font-weight:bold"> {{ date('M-Y', strtotime($factura->periodo)) }}</span>
                    </div>
                </div>
            </div>

            <div class="contenedor_littleform">

                <form action="{{route('editar-detalles', $factura)}}" method="post">

                    @csrf
                    @method('get')

                    <div class="content_gastosdetalles">
                        <div class="divgastosdetal">
                            <label for="gastos">Gastos</label>
                            <select name="gastos" id="gastos">
                                @foreach ($gastos as $gasto)
                                <option value="{{$gasto->id}}" title="Gastos">{{$gasto->descripcion}}</option>;
                                @endforeach
                            </select>
                        </div>
                        <div class="divgastosdetal">
                            <input type="text" name="idfactura" id="idfactura" value="{{$factura->id}}" hidden>
                            <label for="monto">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>
                        <div class="divgastosdetal">
                            <button type="submit" class="boton_form">Validar Gasto</button>
                            <a href="{{ route('facturas.index') }}" class="boton_form">Cerrar</a>
                        </div>
                    </div>
                </form>

                <div class="contenedor_tabla">
                    <table class="tabla">
                        <tr class="table_header">

                            <th class="descripcionF">Descripción del Gasto</th>
                            <th class="montoF">Monto</th>
                            <th>B</th>
                        </tr>
                        @php
                        $subtotal=0;
                        $iva=0;
                        $total=0;
                        @endphp

                        @foreach ($fdetalles as $fdetalle)
                        @if ($fdetalle->factura_id == $factura->id)
                        <tr class="table_item">

                            <td class="t_i descripcion">{{$fdetalle->gasto->descripcion}}</td>
                            <td class="t_i monto" style="text-align:right; padding-right:15px">Bs. {{ number_format($fdetalle->monto, 2, ",", ".")}}</td>
                            @php
                            $subtotal += $fdetalle->monto;
                            @endphp
                            <td>
                                <div class="form_delete">
                                    <form action="{{route('detaledit-destroy', $fdetalle)}}" class="formulario_eliminar" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="text" name="idfactura" id="idfactura" value="{{$factura->id}}" hidden>
                                        <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar detalle de factura"></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                @php
                $iva = $subtotal*.16;
                $total = $subtotal+$iva;

                @endphp
                <div class="contenedor_content_totales">
                    <div class="content_totales">
                        <div class="divtotal">
                            <span style="font-weight:bold">Subtotal: </span>
                            <span style="color:green"> Bs. {{ number_format($subtotal, 2, ',', '.') }}</span>
                        </div>
                        <div class="divtotal">
                            <span style="font-weight:bold">IVA: </span>
                            <span style="color:green">Bs. {{ number_format($iva, 2, ',', '.') }}</span>
                        </div>
                        <div class="divtotal">
                            <span style="font-weight:bold;">Total: </span>
                            <span style="color:green"> Bs. {{ number_format($total, 2, ',', '.') }} </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

