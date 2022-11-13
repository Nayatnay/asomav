@extends('layouts.plantilla')

@section('title', 'Facturas Detalles')

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
                    <h2>Detalles de Facturación</h2>

                </div>
                <div class="centbottom">
                    <div>
                        <span style="font-size:18px;font-weight:bold"> FC#{{ date('m-Y', strtotime($factura->periodo)) }} </span>
                        <span style="font-size:12px;">Fecha: </span>
                        <span style="font-size:12px;font-weight:bold"> {{ date('d-m-Y', strtotime($factura->fecha)) }} </span>
                        <span style="font-size:12px;">Periodo: </span>
                        <span style="font-size:12px;font-weight:bold"> {{ date('M-Y', strtotime($factura->periodo)) }}</span>
                        <span style="font-size:12px;">TASA USD($): </span>
                        <span style="font-size:12px;font-weight:bold"> {{ number_format($factura->tasa, 2, ',', '.') }}</span>

                    </div>
                </div>
            </div>

            <div class="tipodegasto">
                <input type="radio" id="comun" name="tipogasto" value="comun" checked onclick="fnccomun()">
                <label for="comun" style="font-size:14px;font-weight:bold;color:#2b5f00">Gasto Común</label>
                <input type="radio" id="nocomun" name="tipogasto" value="nocomun" onclick="fncnocomun()">
                <label for="nocomun" style="font-size:14px;font-weight:bold;color:#2b5f00">Gasto no común</label>
            </div>

            <form action="{{route('validar-gasto', $factura)}}" method="post" id="formcomun">

                @csrf
                @method('get')

                <div class="content_gastosdetalles">
                    <div class="divgastosdetal">
                        <label for="gastos">Descripción</label>
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

            <form action="{{route('validar-gastonc', $factura)}}" method="post" id="formnocomun" style="display:none;">

                @csrf
                @method('get')

                <div class="content_gastosdetalles">
                    <div class="divgastosdetal">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" value="">
                        @error('descripcion')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    <div class="divgastosdetal">
                        <label for="users">Propietarios</label>
                        <select style="width:150px" name="user_id" id="user_id">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" title="Propietarios">Casa {{$user->calle . "-" . $user->casa . " " . $user->name}}</option>;
                            @endforeach
                        </select>
                    </div>
                    <div class="divgastosdetal">
                        <input type="text" name="idfactura" id="idfactura" value="{{$factura->id}}" hidden>
                        <label for="monto">Monto</label>
                        <input type="number" name="monto" class="numberM" id="montonc" min="1" max="99999.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
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

                        <th class="descripcionF">Gastos Comunes</th>
                        <th class="montoF">Monto</th>
                        <th>B</th>
                    </tr>

                    @foreach ($fdetalles as $fdetalle)
                    
                    <tr class="table_item">

                        <td class="t_i descripcion">{{$fdetalle->gasto->descripcion}}</td>
                        <td class="t_i monto" style="text-align:right; padding-right:15px">Bs. {{ number_format($fdetalle->monto, 2, ",", ".")}}</td>
                        <td>
                            <div class="form_delete">
                                <form action="{{route('detalle-destroy', $fdetalle)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="text" name="idfactura" value="{{$factura->id}}" hidden>
                                    <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar detalle de factura"></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    
                    @endforeach
                </table>
            </div>
            
            <div class="contenedor_tabla">
                <table class="tabla">
                    <tr class="table_header">

                        <th class="descripcionF">Gastos No Comunes</th>
                        <th class="montoF">Monto</th>
                        <th>B</th>
                    </tr>

                    @foreach ($gnoc as $nocomun)
                    
                    <tr class="table_item">

                        <td class="t_i descripcion">{{$nocomun->descripcion . ' / ' . $nocomun->user->calle . '-' . $nocomun->user->casa}}</td>
                        <td class="t_i monto" style="text-align:right; padding-right:15px">Bs. {{ number_format($nocomun->monto, 2, ",", ".")}}</td>
                        <td>
                            <div class="form_delete">
                                <form action="{{route('detallenc-destroy', $nocomun)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="text" name="idfactura" value="{{$factura->id}}" hidden>
                                    <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar detalle de factura"></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</main>
@endsection