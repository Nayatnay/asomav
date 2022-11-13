@extends('layouts.plantilla')

@section('title', 'Pagar Deuda Propietario')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>PAGAR DEUDA</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h3> {{ auth()->user()->name }} {{auth()->user()->calle}}-{{auth()->user()->casa}} </h3>
                </div>
                <div class="saldo">                    
                
                <h3> Deuda Anterior: Bs. {{number_format($saldt, 2, ",", ".")}}</h3> 
                                
                </div>
            </div>



            <div style="background-color:white;padding:20px;margin-top:20px">
                <h3>Reporte aquí el pago de su deuda</h3>



                <div class="content_form_cien">

                    <form action="{{route('usuarios-pago-deudant')}}" method="post">

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
                                <input type="text" name="monto" id="monto" class="pagado" value="{{$saldt}}" autocomplete="off" readonly>

                            </div>
                        </div>
                        @error('monto')
                        <small>*{{$message}}</small>
                        @enderror

                        <input type="text" name="idfac" id="idfac" hidden>

                        <div>
                            <button type="submit" class="boton_form">Procesar Pago</button>
                            <a href="{{ route('usuarios-rpend') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection