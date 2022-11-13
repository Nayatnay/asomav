@extends('layouts.plantilla')

@section('title', 'Gastos Editar')

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
                    <h2>Edición de Gasto Común</h2>
                    <p>Actualiza o Elimina la Información del Gasto</p>
                </div>
                <div>
                    <img src="{!! asset('img/editC.png') !!}" alt="logo editar" width="32">
                </div>
            </div>

            <div class="contenedor_littleform">

                <form action="{{route('gastos.update', $gasto)}}" method="post">

                    @csrf
                    @method('put')

                    <div class="content_input_msg">
                        <label for="name">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del Gasto" value="{{old('descripcion', $gasto->descripcion)}}" autocomplete="off">
                        <br>@error('descripcion')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="boton_form">Actualizar</button>
                        <a href="{{ route('gastos.index') }}" class="boton_form">Cancelar</a>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
@endsection