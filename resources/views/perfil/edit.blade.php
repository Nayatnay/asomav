@extends('layouts.plantilla')

@section('title', 'Perfil Editar')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/usuar.png') !!}" alt="logo propietarios" width="72">
            <h1>MI PERFIL</h1>
        </div>

        <div class="content_ft_white">

            <div class="content_flex">

                <div class="contenedor_perfil">


                    <form action="{{route('perfil.update', $perfil)}}" method="post">

                        @csrf
                        @method('put')
                        <div class="bloq_edit">
                            <p style="color:#2b5f00; font-size:16px;; margin-bottom:15px">Editar Información personal</p>
                        </div>
                        <div class="bloq_edit">
                            <label for="ci">Número de Documento</label>
                            <input type="text" name="ci" value="{{old('ci', $perfil->ci)}}">
                        </div>
                        @error('ci')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="bloq_edit">
                            <label for="name">Usuario</label>
                            <input type="text" name="name" id="name" value="{{old('name', $perfil->name)}}">
                        </div>
                        @error('name')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="bloq_edit">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{old('email', $perfil->email)}}">
                        </div>
                        @error('email')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="bloq_edit">
                            <label for="telf">Teléfono</label>
                            <input type="text" name="telf" placeholder="Teléfono" maxlength="15" value="{{old('telf', $perfil->telf)}}">
                        </div>
                        @error('telf')
                        <small>*{{$message}}</small>
                        @enderror

                        <div class="bloq_edit">
                            <label for="calle">Calle</label>
                            <input type="text" name="calle" placeholder="Nº de Calle" maxlength="3" value="{{old('calle', $perfil->calle)}}" readonly>
                        </div>

                        <div class="bloq_edit">
                            <label for="casa">Casa</label>
                            <input type="text" name="casa" placeholder="Nº de Casa" maxlength="4" value="{{old('casa', $perfil->casa)}}" readonly>
                        </div>

                        <div class="bloq_edit">
                            <label for="alicuota">Alicuota</label>
                            <input type="number" name="alicuota" placeholder="Monto Alicuota Aplicada" step="any" value="{{old('alicuota', $perfil->alicuota)}}" readonly>
                        </div>

                        <div class="bloq_edit">
                            <label for="password">Contraseña</label>
                            <input type="password" name="newpassword" minlength="8" placeholder="Nueva contraseña">
                        </div>
                        <p style="color:orangered; font-size:12px;; margin-top:5px;">* Ingrese una nueva contraseña solo si desea modificarla</p>
                        <div>
                            @if (auth()->user()->hasRole('admin'))
                            <p style="color:#2b5f00; font-size:16px;; margin-top:5px">ROL DE ADMINISTRADOR</p>
                            @else
                            <p style="color:#2b5f00; font-size:16px;; margin-top:5px">ROL DE USUARIO</p>
                            @endif
                        </div>

                        <input type="text" name="password" value="{{$perfil->password}}" hidden>
                        <input type="date" name="email_verified_at" value="<?php echo date('Y-m-d') ?>" hidden>
                        <input type="text" name="remember_token" value="{{Str::random(10)}}" hidden>

                        <div class="bot_edit">
                            <button type="submit" class="boton_form">Enviar cambios</button>
                            <a href="{{ route('perfil.index') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</main>
@endsection