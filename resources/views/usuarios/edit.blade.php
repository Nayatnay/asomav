@extends('layouts.plantilla')

@section('title', 'Propietarios Editar')

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


                    <form action="{{route('usuarios.update', $usuario)}}" method="post">

                        @csrf
                        @method('put')

                        <div class="content_input_msg">
                            <label for="ci">Número de Documento</label>
                            <input type="text" name="ci" placeholder="Nº de Cédula de Identidad" maxlength="10" value="{{old('ci', $usuario->ci) }}">
                            <br>@error('ci')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="name">Propietario</label><br>
                            <input type="text" name="name" id="name" placeholder="Nombre Completo" value="{{old('name', $usuario->name)}}">
                            <br>@error('name')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Correo electrónico" value="{{old('email', $usuario->email)}}">
                            @error('email')
                            <br><small>*{{$message}}</small><br>
                            @enderror

                            <label for="telf">Teléfono</label>
                            <input type="text" name="telf" placeholder="Teléfono" maxlength="15" value="{{old('telf', $usuario->telf)}}">
                            @error('telf')
                            <br><small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="calle">Calle</label>
                            <input type="text" name="calle" placeholder="Nº de Calle" maxlength="3" value="{{old('calle', $usuario->calle)}}">
                            @error('calle')
                            <br><small>*{{$message}}</small><br>
                            @enderror

                            <label for="casa">Casa</label>
                            <input type="text" name="casa" placeholder="Nº de Casa" maxlength="4" value="{{old('casa', $usuario->casa)}}">
                            @error('casa')
                            <br><small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="alicuota">Alicuota</label>
                            <input type="number" name="alicuota" placeholder="Monto Alicuota Aplicada" step="any" value="{{old('alicuota', $usuario->alicuota)}}" style="text-align:right">
                            @error('alicuota')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <input type="text" name="password" value="{{$usuario->password}}" hidden>
                        <input type="date" name="email_verified_at" value="<?php echo date('Y-m-d') ?>" hidden>
                        <input type="text" name="remember_token" value="{{Str::random(10)}}" hidden>

                        <div class="sty_rol">

                            @if ($usuario->hasrole('admin'))
                            <span>ADMINISTRADOR</span>
                                @if (auth()->user()->ci == $usuario->ci)
                                    <p>🔐 Para darse de baja debe solicitarlo a otro Administrador *</p>
                                @else
                                    <label for="rol"> Dar de baja </label>
                                    <input type="checkbox" name="rol" value="1">
                                @endif
                            @else
                                <label for="rol">Asignar Rol de Administrador </label>
                                <input type="checkbox" name="rol" value="2">
                            @endif

                        </div>

                        <div>
                            <button type="submit" class="boton_form">Actualizar</button>
                            <a href="{{ route('usuarios.index') }}" class="boton_form">Cancelar</a>


                        </div>
                        
                    </form>
                </div>

                <div class="propaganda">
                    <img src="{!! asset('img/edit.png') !!}" alt="logo editar" width="80">
                    <h2> Edición de Registros </h2>
                    <p>Actualiza los Datos.  Cambia el Rol del Propietario</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection