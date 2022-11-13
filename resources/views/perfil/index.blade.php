@extends('layouts.plantilla')

@section('title', 'Perfil Usuario')

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

                    <div class="content_cuenta">

                        <h3 class="titul" style="color:#2b5f00; font-weight:bold">Cuenta</h3>
                        <p style="font-size: 20px;font-weight:bold">{{ $perfil->name }}</p>
                        <p style="font-size: 14px;font-weight:bold">{{ $perfil->email }}</p>

                        @if (auth()->user()->hasRole('admin'))
                        <p style="color:#2b5f00; font-size:16px;; margin-top:5px">ADMINISTRADOR</p>
                        @else
                        <p style="color:#2b5f00; font-size:16px;; margin-top:5px">USUARIO</p>
                        @endif

                    </div>

                    <div class="content_detal_cuenta">

                        <h3 class="titul" style="color:#2b5f00; font-weight:bold">Información Personal</h3>
                        <div class="item">
                            <img src="{!! asset('img/ced.png') !!}" alt="" width="32">
                            <p>Documento Nº {{ $perfil->ci }}</p>
                        </div>

                        <div class="item">
                            <img src="{!! asset('img/telf.png') !!}" alt="" width="32">
                            <p>Teléfono {{ $perfil->telf }}</p>
                        </div>
                        <div class="item">
                            <img src="{!! asset('img/calle.png') !!}" alt="" width="32">
                            <p>Calle {{ $perfil->calle }}</p>
                        </div>
                        <div class="item">
                            <img src="{!! asset('img/home2.png') !!}" alt="" width="32">
                            <p>Casa {{ $perfil->casa }}</p>
                        </div>
                        <div class="item">
                            <img src="{!! asset('img/alicu.png') !!}" alt="" width="32">
                            <p>Alicuota {{ $perfil->alicuota }}</p>
                        </div>
                    </div>

                    <div class="boton_perfil">
                        <div>
                            <div>
                                <a href="{{route('perfil.edit', $perfil)}}">Editar Perfil</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


</main>
@endsection