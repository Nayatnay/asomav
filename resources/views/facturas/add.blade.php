@extends('layouts.plantilla')

@section('title', 'Facturas Registrar')

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
                    <h2>Nueva Facturación</h2>
                    <p>Ingresa los Datos de la Factura</p>
                </div>
                <div class="centbottom">
                    <img src="{!! asset('img/concilc.png') !!}" alt="logo facturación" width="24" class="">
                    <p>VALIDAR PARA DETALLES</p>
                </div>
            </div>

            <div class="contenedor_littleform">

                <form action="{{route('facturas.store')}}" method="post">

                    @csrf


                    <div class="content_input_msg">
                        <label for="fecha">Fecha de Facturación</label><br>
                        <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" autocomplete="off">
                        <br>@error('fecha')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    <div class="content_input_msg">
                        <label for="periodo">Periodo</label><br>
                        <input type="month" name="periodo" id="periodo" value="{{old('periodo')}}" autocomplete="off">
                        <br>@error('periodo')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="content_input_msg">
                        <br><label for="tasa">Tasa Cotización de la Divisa ($)</label>
                        <input type="number" name="tasa" class="numberM" id="monto" min="1" max="99.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
                        @error('tasa')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="alerta">
                        @if (session('info'))
                        <span>Existe una facturación en el periodo indicado. Verifique.</span>
                        <span>🔐</span>
                        @endif
                    </div>
                    <div class="botones" style="padding-bottom:10px;">
                        <button type="submit" class="boton_form">Validar y agregar detalles</button>
                        <a href="{{ route('facturas.index') }}" class="boton_form">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
</main>
@endsection