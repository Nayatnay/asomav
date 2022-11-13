@extends('layouts.plantilla')

@section('title', 'Servicios Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/prov.png') !!}" alt="logo proveedores" width="72">
            <h1>PROVEEDORES</h1>
        </div>

        <div class="content_ft">

            <div class="flex_center_left">

                <div style="padding:5px">

                </div>

                <div>
                    <form action="{{ route('gastos-ctaprov') }}" class="form-container">
                        <select name="servicios" id="gastoid" style="color:grey;font-size:12px;padding:10px;border:1px solid grey" onchange="llenar(this.options)">
                            <option>Seleccione Servicio o Proveedor</option>;
                            @foreach ($gastos as $gasto)
                            <option value="{{$gasto->id}}" name="gasto" title="Gastos">{{$gasto->descripcion}}</option>;
                            @endforeach
                        </select>

                        <input type="search" placeholder="Buscar en la lista" id="descripcion" name="buscar" value="{{ $buscar }}" hidden>
                        <button type="submit" class="boton_form">Consultar</button>
                    </form>
                </div>
            </div>


            <div>
                <h3 style="padding:10px;color:#af6900">{{$buscar}}</h3>
            </div>

            <div>
                <table style="border:1px solid white; padding:5px;margin:5px;font-size:14px;text-align:center">
                    <tr style="background-color:white;height:25px">
                        <th style="width:120px">Facturado</th>
                        <th style="width:120px">Periodo</th>
                        <th style="width:120px">Monto</th>
                    </tr>
                    @foreach ($fdetalles as $fdetalle)
                    <tr style="font-size:12px;height:25px">
                        @php
                        $total = $total + $fdetalle->monto;
                        @endphp
                        <td >{{date('d-m-Y', strtotime($fdetalle->factura->fecha))}}</td>
                        <td >{{date('m-Y', strtotime($fdetalle->factura->periodo))}}</td>
                        <td style="text-align:right;padding-right:10px">Bs. {{ number_format($fdetalle->monto, 2, ",", ".")}}</td>
                    </tr>
                    @endforeach
                    @php
                    $totalf = $total;
                    $total = 0;
                    @endphp
                </table>
            </div>

            <div>
                <table style="border:1px solid white; padding:5px;margin:5px;font-size:14px;text-align:center">
                    <tr style="background-color:white;height:25px">
                        <th style="width:120px">Fecha de abono</th>
                        <th style="width:120px">Total</th>
                    </tr>
                    @foreach ($fondos as $fondo)
                    <tr style="font-size:12px;height:25px">
                        @php
                        $total = $total + $fondo->abono;
                        @endphp
                        <td>{{date('d-m-Y', strtotime($fondo->fecha))}}</td>
                        <td style="text-align:right;padding-right:10px">Bs. {{ number_format($fondo->abono, 2, ",", ".")}}</td>
                    </tr>
                    @endforeach
                    @php
                    $totalb = $total;
                    $total = $totalf - $totalb;
                    @endphp
                </table>
            </div>

            <div class="flex_center_left" style="font-size:12px">
                <div class="flex_center_beetw" style="background-color:#2f5301;border:1px solid white;padding:10px;margin:5px;width:250px">
                    <p style="font-weight:bold;color:white">Total facturado: </p>
                    <p style="margin:0px 8px;color:white">Bs. {{ number_format($totalf, 2, ",", ".") }}</p>
                </div>
                <div class="flex_center_beetw" style="background-color:whitesmoke;border:1px solid white;padding:10px;margin:5px;width:250px">
                    <p style="font-weight:bold;color:#313131">Total abonado: </p>
                    <p style="margin:0px 8px;color:black">Bs. {{ number_format($totalb, 2, ",", ".") }}</p>
                </div>
                <div class="flex_center_beetw" style="background-color:#af6900;border:1px solid white;padding:10px;margin:5px;width:250px">
                    <p style="color:white">Pendiente de pago: </p>
                    <p style="margin:0px 8px;color:white">Bs. {{ number_format($total, 2, ",", ".") }}</p>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection