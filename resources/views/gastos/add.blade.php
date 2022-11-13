@extends('layouts.plantilla')

@section('title', 'Gastos Registrar')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/gastos.png') !!}" alt="logo gastos" width="72">
            <h1>GASTOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Nuevo Gasto Común</h2>
                    <p>Ingresa los Datos del Gasto</p>
                </div>
                <div>
                    <img src="{!! asset('img/gaser2C.png') !!}" alt="logo gastos" width="168" class="">
                </div>
            </div>

            <div class="contenedor_littleform">

                <form action="{!! url('gastos') !!}" method="post">

                    @csrf

                    <div class="content_input_msg">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del Gasto" value="{{old('descripcion')}}" autocomplete="off">
                        <br>@error('descripcion')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="boton_form">Aceptar</button>
                        <a href="{{ route('gastos.index') }}" class="boton_form">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection