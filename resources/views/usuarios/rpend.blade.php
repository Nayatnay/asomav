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
                    <h3> {{ auth()->user()->name }} {{auth()->user()->calle}}-{{auth()->user()->casa}} </h3>
                </div>
                <div class="saldo">

                    @if ($saldt <> 0)
                        <h3> Deuda Anterior: Bs. {{number_format($saldt, 2, ",", ".")}}</h3>
                        <a href="{{route('usuarios-deudaform', $usuario)}}"> Pagar Aquí </a>
                        @endif

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
                            <th style="min-width:20px">Pagar</th>

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
                                <td><input type="checkbox" name="pagar" value="" class="pagar" title="Pagar" disabled> </td>
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

                                @if ($cuentas->estatus == NULL)
                                <td><input type="checkbox" name="pagar" value="{{$total}}" class="pagar" title="Pagar" onClick="if (this.checked) sumar(<?php echo $total ?>)&idfact(<?php echo $cuentas->factura_id ?>); else restar(<?php echo $total ?>)&idnofact(<?php echo $cuentas->factura_id ?>)"></td>
                                @else
                                <td><input type="checkbox" name="pagar" value="" class="pagar" title="Pagar" disabled> </td>
                                @endif

                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>

            <div style="background-color:white;padding:20px">
                <h3>Reporte aquí su pago</h3>



                <div class="content_form_cien">

                    <form action="{{route('usuarios-pagos')}}" method="post">

                        @csrf

                        <div class="flex_center_left" style="font-size:12px;margin:10px">

                            <div style="padding:10px">
                                <p>Tipo Operación</p>
                            </div>

                            <div style="padding:10px">
                                <input type="radio" id="pagomovil" name="tipoperacion" value="PagoMóvil" checked>
                                <label for="pagomovil">Pago Móvil</label><br>
                                <input type="radio" id="mismobco" name="tipoperacion" value="Operación MB">
                                <label for="mismobco">Depósito/Transferencia Mismo Banco</label><br>
                                <input type="radio" id="otrobco" name="tipoperacion" value="Operación OB">
                                <label for="otrobco">Depósito/Transferencia Otro Banco</label>
                            </div>

                        </div>

                        <div class="flex_center_left">
                            <div class="divspan">
                                <span>Nº Operación: </span>
                            </div>
                            <div class="divinput">
                                <input type="text" name="operacion" placeholder="Nº Operación/Referencia" maxlength="11" value="{{old('operacion')}}" autocomplete="off">
                            </div>
                        </div>
                        @error('operacion')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="flex_center_left">
                            <div class="divspan">
                                <span>Fecha Operación: </span>
                            </div>
                            <div class="divinput" style="border:1px solid lightgrey">
                                <input style="width:200px;border:none" type="date" name="fecha" id="fecha" placeholder="Fecha de Operación" value="{{old('fecha')}}" autocomplete="off">
                            </div>
                        </div>
                        @error('fecha')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="flex_center_left">
                            <div class="divspan">
                                <span>Cédula Id. (Pagador): </span>
                            </div>
                            <div class="divinput">
                                <input type="text" name="ci" placeholder="Cédula Id. Pagador" maxlength="11" value="{{old('ci')}}" autocomplete="off">

                            </div>
                        </div>
                        @error('ci')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="flex_center_left">
                            <div class="divspan">
                                <span>Nº Teléfono (Pagador): </span>
                            </div>
                            <div class="divinput">
                                <input type="text" name="telf" placeholder="Nº Telf. Pagador" maxlength="20" value="{{old('telf')}}" autocomplete="off">

                            </div>
                        </div>
                        @error('telf')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="flex_center_left">
                            <div class="divspan">
                                <span>Monto Operación: </span>
                            </div>
                            <div class="divinput">
                                <input type="text" name="monto" id="monto" class="pagado" placeholder="0.00" autocomplete="off" readonly>

                            </div>
                        </div>
                        @error('monto')
                        <small>*{{$message}}</small>
                        @enderror

                        <input type="text" name="idfac" id="idfac" hidden>

                        <div>
                            <button type="submit" class="boton_form">Procesar Pago</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection