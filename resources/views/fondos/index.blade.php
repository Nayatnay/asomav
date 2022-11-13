@extends('layouts.plantilla')

@section('title', 'Finanzas Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/finanzc.png') !!}" alt="logo finanzas" width="72">
            <h1>FINANZAS</h1>
        </div>

        <div class="content_ft">

            <div class="saldos" style="display:flex">

                <div style="color:#325000;margin:0px 10px" class="flex_center_right">
                    <div class="flex_center_center_column">
                        <p style="color:#505050;font-size:10px;font-weight:bold">FONDO DE RESERVA</p>
                        <h2>{{number_format($totalr, 2, ",", ".")}}</h2>
                        <p style="color:#505050;font-size:11px;font-weight:bold">B o l í v a r e s</p>
                    </div>
                </div>

                <div style="margin:0px 10px" class="flex_center_right">
                    <div class="flex_center_center_column">
                        <p style="font-size:10px;font-weight:bold">SALDO EN CUENTA</p>
                        <h2>{{number_format($total, 2, ",", ".")}}</h2>
                        <p style="font-size:11px;font-weight:bold">B o l í v a r e s</p>
                    </div>
                </div>

            </div>

            @php
            $total = 0;
            @endphp
            <div class="tope">

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('fondos.index') }}" class="form-container">
                        <input type="search" placeholder="Buscar en la lista" name="buscar" value="{{ $buscar }}">
                        <button type="submit" class="butbuscar" title="Buscar">Buscar</button>
                    </form>
                </div>

                @if (session('info'))
                <div class="alerta">
                    <p>Movimiento de cuenta bloqueado 🔐</p>
                </div>
                @endif
                
                <div class="flexgrap">
                    <a href="{{route('fondos.create')}}" title="Ingreso a Cuenta"><img src="{!! asset('img/ingre.png') !!}" alt="logo ingreso" width="32"></a>
                    <a href="{{route('fondos-egresos')}}" title="Egreso de Cuenta"><img src="{!! asset('img/egre.png') !!}" alt="logo egresos" width="32"></a>
                    <a href="{{route('fondos-reservas')}}" title="Fondo de Reserva"><img src="{!! asset('img/reser.png') !!}" alt="logo egresos" width="32"></a>
                    
                    <p> | </p>
                    <div style="margin:0px 5px">
                    <form action="{{route('fondos-pdf')}}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="botonverde" title="Imprimir"><img src="{!! asset('img/print.png') !!}" alt="logo Imprimir" width="32"></button>
                    </form>
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="tabla">
                    <tr class="table_header">
                        <th class="fecha">Fecha</th>
                        <th class="descripcion">Descripcion</th>
                        <th class="Cargo">Cargo</th>
                        <th class="abono">Abono</th>
                        <th class="saldo">Saldo</th>
                        <th class="edt"></th>
                        <th class="era"></th>

                    </tr>

                    @if(count($fondos)<=0) <tr>
                        <td colspan="9" class="negritas">No hay resultados</td>
                        </tr>
                        @else
                        @foreach ($fondos as $fondo)

                        @php
                        $total = $total + $fondo->cargo - $fondo->abono;
                        @endphp
                        <tr class="table_item">
                            <td class="t_i">{{ date('d-m-Y', strtotime( $fondo->fecha )) }}</td>
                            <td class="t_i">{{ $fondo->descripcion }}</td>
                            <td class="t_i">{{ number_format($fondo->cargo, 2, ",", ".") }}</td>
                            <td class="t_i">{{ number_format($fondo->abono, 2, ",", ".") }}</td>
                            <td class="t_i">{{ number_format($total, 2, ",", ".") }}</td>
                            <td><a href="{{route('fondos.edit', $fondo)}}" title="Editar"><img src="{!! asset('img/edit.png') !!}" alt="logo editar" width="24" title="Editar"></a></td>
                            <td>
                                <div class="form_delete">
                                    <form action="{{route('fondos.destroy', $fondo)}}" class="formulario_eliminar" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="" title="Eliminar"><img src="{!! asset('img/erase2.png') !!}" alt="" width="24" title="Eliminar"></button>
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

<script>
    $('.formulario_eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Está seguro?',
            text: "Esta acción eliminará el movimiento de caja. ¡No podrás revertir esto!",
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