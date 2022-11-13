@extends('layouts.plantilla')

@section('title', 'Propietarios Registrar')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/prop.png') !!}" alt="logo propietarios" width="72">
            <h1>PROPIETARIOS</h1>
        </div>

        <div class="content_ft">

            <div class="content_flex">

                <div class="contenedor_form_prop">


                    <form action="{!! url('usuarios') !!}" method="post">

                        @csrf

                        <div class="content_input_msg">
                            <label for="ci">Número de Documento</label>
                            <input type="text" name="ci" placeholder="Nº de Cédula de Identidad" maxlength="10" value="{{old('ci')}}" autocomplete="off">
                            <br>@error('ci')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="name">Propietario</label><br>
                            <input type="text" name="name" id="name" placeholder="Nombre Completo" value="{{old('name')}}" autocomplete="off">
                            <br>@error('name')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Correo electrónico" value="{{old('email')}}" autocomplete="off">
                            @error('email')
                            <br><small>*{{$message}}</small><br>
                            @enderror

                            <label for="telf">Teléfono</label>
                            <input type="text" name="telf" placeholder="Número Telefónico" maxlength="15" value="{{old('telf')}}" autocomplete="off">
                            @error('telf')
                            <br><small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="calle">Calle</label>
                            <input type="text" name="calle" placeholder="Nº de Calle" maxlength="3" value="{{old('calle')}}" autocomplete="off">
                            @error('calle')
                            <br><small>*{{$message}}</small><br>
                            @enderror

                            <label for="casa">Casa</label>
                            <input type="text" name="casa" placeholder="Nº de Casa" maxlength="4" value="{{old('casa')}}" autocomplete="off">
                            @error('casa')
                            <br><small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="alicuota">Alicuota</label>
                            <input type="number" name="alicuota" placeholder="Monto Alicuota Aplicada" step="any" value="{{old('alicuota')}}" autocomplete="off" style="text-align:right">
                            @error('alicuota')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="deuda">Deuda Anterior</label>
                            <input type="number" name="deuda" placeholder="Deuda anterior" step="any" value="{{old('monto')}}" autocomplete="off" style="text-align:right">
                            @error('deuda')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <input type="text" name="password" value="$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" hidden>
                        <input type="datetime" name="email_verified_at" value="<?php echo date('Y-m-d') ?>" hidden>
                        <input type="text" name="remember_token" value="{{Str::random(10)}}" hidden>
                        
                        <div>
                            <button type="submit" class="boton_form">Agregar</button>
                            <a href="{{ route('usuarios.index') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>

                <div class="propaganda">
                    <img src="{!! asset('img/nomin.png') !!}" alt="logo propietarios" width="auto">
                    <h2>Nuevos Registros</h2>
                    <p>Ingresa los datos de nuevos registros</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection