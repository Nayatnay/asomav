@extends('layouts.plantilla')

@section('title', 'Deuda Anterior Propietario')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/handw.png') !!}" alt="logo Cerrar factura" width="72">
            <h1>DEUDA ANTERIOR</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div style="margin-bottom:15px">
                    <h3>{{$usuario->name}} {{$usuario->calle}}-{{$usuario->casa}} </h3>
                </div>
            </div>

            <div class="contenedor_form_prop">

                <form action="{{route('saldos.update', $saldo)}}" method="post">

                    @csrf
                    @method('put')

                    <div class="content_input_msg">
                        <label for="cargo">Deuda Anterior</label>
                        <input type="number" name="cargo" placeholder="Monto Deuda Anterior" step="any" value="{{old('cargo', $saldo->cargo)}}" style="text-align:right">
                        @error('cargo')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="boton_form">Actualizar</button>
                        <a href="{{ route('usuarios-cxc', $usuario) }}" class="boton_form">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
@endsection