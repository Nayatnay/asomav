@extends('layouts.plantilla')

@section('title', 'Propietarios Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/prop.png') !!}" alt="logo propietarios" width="72">
            <h1>PROPIETARIOS</h1>
        </div>

        <div class="content_ft">

            <div class="tope">

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('usuarios.index') }}" class="form-container">
                        <input type="search" placeholder="Buscar en la lista" name="buscar" value="{{ $buscar }}">
                        <button type="submit" class="butbuscar">Buscar</button>
                    </form>
                </div>

                @if (session('info'))
                <div class="alerta">
                    <span>Solicítelo a otro Administrador </span>
                    <span>🔐</span>
                </div>
                @endif


                <div class="botagre">
                    <a href="{{route('usuarios.create')}}">Agregar</a>
                </div>



            </div>

            <div class="table-responsive">
                <table class="tabla">
                    <tr class="table_header">
                        <th class="nombre">Nombre</th>
                        <th class="calle">Calle</th>
                        <th class="casa">Casa</th>
                        <th class="ci">CI</th>
                        <th class="email">Email</th>
                        <th class="telf">Telf</th>
                        <th class="alicuota">Alicuota</th>
                        <th class="edt"></th>
                        <th class="era"></th>
                        <th class="cxc"></th>
                        <th class="edo"></th>
                        <th class="rec"></th>
                    </tr>

                    @if(count($usuarios)<=0) <tr>
                        <td colspan="9" class="negritas">No hay resultados</td>
                        </tr>
                        @else
                        @foreach ($usuarios as $usuario)

                        <tr class="table_item">
                            <td class="t_i">{{ $usuario->name }}</td>
                            <td class="t_i">{{ number_format($usuario->calle, 0) }}</td>
                            <td class="t_i">{{ number_format($usuario->casa, 0) }}</td>
                            <td class="t_i">{{ $usuario->ci }}</td>
                            <td class="t_i">{{ $usuario->email }}</td>
                            <td class="t_i">{{ $usuario->telf }}</td>
                            <td class="t_i">{{ number_format($usuario->alicuota, 2, ",", ".") }}</td>
                            <td><a href="{{route('usuarios.edit', $usuario)}}"><img src="{!! asset('img/edit.png') !!}" alt="logo editar" width="24" title="Editar"></a></td>
                            <td>
                                <div class="form_delete">
                                    <form action="{{route('usuarios.destroy', $usuario)}}" class="formulario_eliminar" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar Propietario"></button>
                                    </form>
                                </div>
                            </td>
                            <td><a href="{{route('usuarios-cxc', $usuario)}}"><img src="{!! asset('img/handw.png') !!}" alt="logo cxc" width="24" title="Deuda"></a></td>
                            <td><a href="{{route('usuarios-mov', $usuario)}}"><img src="{!! asset('img/edocta.png') !!}" alt="logo edocta" width="24" title="Movimientos"></a></td>
                            <td><a href="{{route('usuarios-rpend-adm', $usuario)}}"><img src="{!! asset('img/recib.png') !!}" alt="logo recibos" width="24" title="Recibos"></a></td>
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

<script>
    $('.formulario_eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Está seguro?',
            text: "Esta acción eliminará toda la nformación del propietario. ¡No podrás revertir esto!",
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