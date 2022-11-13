@extends('layouts.plantilla')

@section('title', 'Comunicados Editar')

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
                    <h2>Editar Comunicado</h2>
                    <p>Actualiza o Elimina la Información del Comunicado</p>
                </div>
                <div>
                <div class="flex_center_start">
                <form action="{{route('comunicados.destroy', $comunicado)}}" class="formulario_eliminar" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="boton_img" title="Borrar"><img src="{!! asset('img/erase2.png') !!}" alt="logo papelera" width="20" title="Borrar"></button>
                </form>

                <form action="{{route('create-pdf', $comunicado)}}" method="GET" target="_blank">
                    @csrf

                    <button type="submit" class="boton_img" title="Imprimir"><img src="{!! asset('img/printw.png') !!}" alt="logo Imprimir" width="20" title="Imprimir"></button>
                </form>
            </div>

                </div>
            </div>

            
            <div class="contenedor_littleform">

                <form action="{{route('comunicados.update', $comunicado)}}" method="post">

                    @csrf
                    @method('put')

                    <div class="content_input_msg">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" placeholder="Ingrese Fecha" value="{{old('fecha', $comunicado->fecha)}}" autocomplete="off" autofocus>
                        <br>@error('fecha')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="content_input_msg">
                        <label for="encabezado">Asunto</label>
                        <input type="text" name="encabezado" placeholder="Ingrese asunto..." maxlength="50" value="{{old('encabezado', $comunicado->encabezado)}}" autocomplete="off" required>
                        <br>@error('encabezado')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    <br>
                    <div class="content_parrafotextarea">
                        <div class="wrapper">
                            <label for="cuerpo">Cuerpo del Comunicado</label><br><br>
                            <textarea id="cuerpo" name="cuerpo" class="input_cuerpo" required>{{old('cuerpo', $comunicado->cuerpo)}}</textarea>
                            <br>@error('cuerpo')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>


                    <div>
                        <button type="submit" class="boton_form">Actualizar</button>
                        <a href="{{ route('comunicados.index') }}" class="boton_form">Cancelar</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</main>
@endsection

@section('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar') == 'ok')
<script>
    Swal.fire({
        type: 'success',
        title: 'Eliminado!',
        text: 'La información se eliminó con éxito.',
        confirmButtonColor: '#2f5301',
        confirmButtonText: 'OK'
    })
</script>
@endif

<script>
    $('.formulario_eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Está seguro?',
            text: "Se perderá toda la información. ¡No podrás revertir esto.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2f5301',
            cancelButtonColor: '#af6900',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })

    })
</script>

<!--
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#cuerpo'))
        .catch(error => {
            console.error(error);
        });
</script>
-->

<script>
    window.onload = function() {
        const cuerpo = document.querySelector("textarea")
        let scHeight = cuerpo.scrollHeight;
        cuerpo.style.height = scHeight + 'px';
    }
</script>

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