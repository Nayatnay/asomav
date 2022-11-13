@extends('layouts.plantilla')

@section('title', 'Finanzas Ingresos')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/finanzc.png') !!}" alt="logo propietarios" width="72">
            <h1>FINANZAS</h1>
        </div>

        <div class="content_ft">

            <div class="content_flex">

                <div class="contenedor_form_prop">


                    <form action="{!! url('fondos') !!}" method="post">

                        @csrf
                        <!--
                        <div class="tipofondo">
                            <input type="radio" id="ingreso" name="tipofondo" value="ingreso" checked>
                            <label for="ingreso" style="font-size:14px;font-weight:bold;color:#2b5f00">Ingreso</label>
                            <input type="radio" id="egreso" name="tipofondo" value="egreso">
                            <label for="egreso" style="font-size:14px;font-weight:bold;color:#2b5f00">Egreso</label>
                        </div>
-->
                        <div style="padding:10px">
                            <h3>Ingreso a Cuenta</h3>
                        </div>

                        <div class="content_input_msg">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" autocomplete="off">
                            <br>@error('fecha')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del Ingreso" value="{{old('descripcion')}}" autocomplete="off" style="width: 100%;">
                            <br>@error('descripcion')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <input type="text" name="cod_id" value="0" hidden>
                        <input type="text" id="tipofondo" name="tipofondo" value="ingreso" hidden>

                        <div>
                            <button type="submit" class="boton_form" title="Agregar">Agregar</button>
                            <a href="{{ route('fondos.index') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

</main>
@endsection