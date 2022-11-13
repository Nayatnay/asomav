@extends('layouts.plantilla')

@section('title', 'Gastos Asomavilla')

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
                    <h2>Conceptos de Gastos</h2>
                    <p>Causados por la Administración, Conservación, Reparación y/o Reposición de las áreas comunes.</p>
                </div>
                <div>
                    <img src="{!! asset('img/gaser2C.png') !!}" alt="logo gastos" width="192" class="">
                </div>
            </div>

            <div class="tope">

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('gastos.index') }}" class="form-container">
                        <input type="search" placeholder="Buscar en la lista" name="buscar" value="{{ $buscar }}">
                        <button type="submit" class="butbuscar">Buscar</button>
                    </form>
                </div>

                <div class="botagre">
                    <a href="{{route('gastos.create')}}">Agregar</a>
                </div>
            </div>

            <div class="contenedor_tabla">
                <table class="tabla">
                    <tr class="table_header">
                        <th class="descripcion">Descripción del Gasto</th>
                        <th>E</th>
                        <th>B</th>
                    </tr>

                    @if(count($gastos)<=0) 
                    
                    <tr>
                        <td colspan="4" class="negritas">No hay resultados</td>
                    </tr>
                        
                    @else
                        
                        @foreach ($gastos as $gasto)

                        <tr class="table_item">

                            <td class="t_i descripcion">{{ $gasto->descripcion }}</td>
                            <td><a href="{{route('gastos.edit', $gasto)}}"><img src="{!! asset('img/edit.png') !!}" alt="logo edición" width="24" title="Editar"></a></td>
                            <td>
                                <div class="form_delete">
                                    <form action="{{route('gastos.destroy', $gasto)}}" CLASS="formulario_eliminar" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar Gasto"></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        
                        @endforeach

                    @endif
                </table>
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

@if (session('eliminar') == 'no')
<script>
    
    Swal.fire({
        type: 'error',
        title: 'Imposible Eliminar!',
        text: 'El gasto ha sido procesado en Recibos CDM.',
        confirmButtonColor: '#ff0000',
        confirmButtonText: 'OK'
    })

</script>
@endif

@if (session('editar') == 'no')
<script>
    
    Swal.fire({
        type: 'error',
        title: 'Imposible Editar!',
        text: 'El gasto ha sido procesado en Recibos CDM.',
        confirmButtonColor: '#ff0000',
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

@endsection