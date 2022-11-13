@extends('layouts.plantilla')

@section('title', 'facturas Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/concil.png') !!}" alt="logo facturación" width="72">
            <h1>FACTURACION</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Registro de Gastos por periodo</h2>
                    <p>Generados por mantenimiento</p>
                </div>
                <div class="centbottom">
                    <img src="{!! asset('img/concilc.png') !!}" alt="logo facturación" width="24" class="">
                    <p>AGREGAR PARA DETALLES</p>
                </div>
            </div>

            <div class="tope">

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('facturas.index') }}" class="form-container">
                        <input type="search" placeholder="Buscar en la lista" name="buscar" value="{{ $buscar }}">
                        <button type="submit" class="butbuscar">Buscar</button>
                    </form>
                </div>
                @if (session('info'))
                <div class="estado">
                    <p>No procede. Estado Actual: CERRADO 🔐</p>
                </div>
                @endif
                <div class="botagre">
                    <a href="{{route('facturas.create')}}">Nuevo Registro</a>
                </div>
            </div>

            <div class="contenedor_tabla">
                <table class="tabla">
                    <tr class="table_header">
                        <th style="min-width:80px"  class="numfac">Periodo</th>
                        <th class="numfac">Fecha de Facturación</th>
                        <th class="numfac">Tasa Cotización</th>
                        <th>Cerrar</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>

                    @if(count($facturas)<=0) <tr>
                        <td colspan="4" class="negritas">No hay resultados</td>
                        </tr>
                        @else
                        @foreach ($facturas as $factura)

                        <tr class="table_item">

                            <td class="t_i periodo">{{ date('m-Y', strtotime($factura->periodo)) }}</td>
                            <td class="t_i fecha">{{ date('d-m-Y', strtotime( $factura->fecha)) }}</td>
                            <td class="t_i tasa"> $ {{ number_format($factura->tasa, 2, ',', '.')}}</td>
                            <td><a href="{{route('facturas.show', $factura)}}"><img src="{!! asset('img/eyeW.png') !!}" alt="logo Ver" width="24" title="Visualizar y Cerrar Recibo CDM"></a></td>
                            <td><a href="{{route('detalles-factura', $factura)}}"><img src="{!! asset('img/edit.png') !!}" alt="logo edición" width="24" title="Editar Factura"></a></td>
                            <td>
                                <div class="form_delete">
                                    <form action="{{route('facturas.destroy', $factura)}}" class="formulario_eliminar" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=""><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar factura"></button>
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
        text: 'Estado actual de la factura: CERRADO.',
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