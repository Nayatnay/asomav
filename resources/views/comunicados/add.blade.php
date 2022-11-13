@extends('layouts.plantilla')

@section('title', 'Comunicados Crear')

@section('content')


<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/comu.png') !!}" alt="logo gastos" width="72">
            <h1>COMUNICADOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Nuevo Comunicado</h2>
                    <p>Ingresa fecha e información de interés</p>
                </div>
                <div>
                    <div class="centbottom">
                        <img src="{!! asset('img/logo2.png') !!}" alt="logo gastos" width="32" class="">
                        <p>ASOMAVILLA</p>
                    </div>
                </div>
            </div>

            <div class="contenedor_littleform">

                <form action="{!! url('comunicados') !!}" method="post">

                    @csrf

                    <div class="content_input_msg">
                        <label for="fecha">Fecha</label><br>
                        <input type="date" name="fecha" placeholder="Ingrese Fecha" value="{{old('fecha')}}" autocomplete="off" autofocus>
                        <br>@error('fecha')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="content_input_msg">
                        <label for="encabezado">Asunto</label><br>
                        <input type="text" name="encabezado" placeholder="Ingrese asunto..." maxlength="50" value="{{old('encabezado')}}" autocomplete="off" required>
                        <br>@error('encabezado')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    <br>
                    <div class="wrapper">
                        <label for="cuerpo">Cuerpo del Comunicado</label><br><br>
                        <textarea placeholder="Transcribir aquí..." id="cuerpo" name="cuerpo" class="input_cuerpo" maxlength="1800" required >{{old('cuerpo')}}</textarea>
                        <br>@error('cuerpo')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="boton_form">Guardar</button>
                        <a href="{{ route('comunicados.index') }}" class="boton_form">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')

<script>
    //textarea auto resize de acuerdo al texto introducido
    const cuerpo = document.querySelector("textarea")
    cuerpo.addEventListener("keyup", e => {
        cuerpo.style.height = '65px';
        let scHeight = cuerpo.scrollHeight;
        cuerpo.style.height = scHeight + 'px';
    });
</script>
@endsection