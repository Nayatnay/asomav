@extends('layouts.plantilla')

@section('title', 'Finanzas Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo finanzas" width="72">
            <h1>PAGOS</h1>
        </div>

        <div class="content_ft">

            <div style="color:#325000" class="flex_center_right">
                <div class="flex_center_center_column">
                    <p style="color:#505050;font-size:10px">SALDO EN CUENTA</p>
                    <h2>{{number_format($total, 2, ",", ".")}}</h2>
                    <p style="color:#505050;font-size:11px">B o l í v a r e s</p>
                </div>
            </div>

            <div>

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('gastos-proveedores') }}" class="form-container">

                        <label for="gastos">Descripción de Cuenta</label>
                        <select name="buscar" id="buscar">
                            <option>--Seleccione una cuenta--</option>;
                            @foreach ($gastos as $gasto)
                            <option value="{{$gasto->id}}" title="Gastos">{{$gasto->descripcion}}</option>;
                            @endforeach
                        </select>


                        <button type="submit" class="butbuscar" title="Consultar">Consultar</button>
                    </form>
                </div>

            </div>

            <h2 style="text-align:center">{{$namegasto}}</h2>

            <div class="contenedor_tabla">
                <table class="tabla">

                    <tr class="table_header">
                        <th class="recibo">RECIBO</th>
                        <th class="gasto">gasto id</th>
                        <th class="monto">Monto</th>

                    </tr>

                    @foreach ($fdetalles as $fdetalle)
                    <tr class="table_item">
                        <td>{{date('m-Y', strtotime($fdetalle->factura->periodo))}}</td>
                        <td>{{$fdetalle->gasto_id}}</td>
                        <td>{{$fdetalle->monto}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</main>

@endsection