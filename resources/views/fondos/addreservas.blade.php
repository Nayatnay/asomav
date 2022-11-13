@extends('layouts.plantilla')

@section('title', 'Fondo de Reserva')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/finanzc.png') !!}" alt="logo propietarios" width="72">
            <h1>FINANZAS</h1>
        </div>

        <div class="content_ft">

            <div class="content_flex">

                <div class="contenedor_form_prop">


                    <form action="{!! url('fondos-reservas-create') !!}" method="post">

                        @csrf

                        <div style="padding:10px">
                            <h3>Fondo de Reserva</h3>
                        </div>

                        <div>
                            <p style="text-align:center;font-size:11px;padding:5px;background-color:rgb(47,83,1);color:white">Los cargos o abonos que realice al Fondo de Reserva se reflejarán como un movimiento entre cuentas y serán debitados o cargados en el Saldo de Cuenta</p>
                        </div>

                        <div class="tipofondo" style="padding:10px">
                            <input type="radio" id="cargo" name="tipofondo" value="cargo" checked>
                            <label for="cargo" style="font-size:14px;font-weight:bold;color:#2b5f00">Cargo</label>
                            <input type="radio" id="abono" name="tipofondo" value="abono">
                            <label for="abono" style="font-size:14px;font-weight:bold;color:#2b5f00">Abono</label>
                        </div>

                        

                        <div class="content_input_msg">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" autocomplete="off">
                            <br>@error('fecha')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="boton_form" title="Agregar">Agregar</button>
                            <a href="{{ route('fondos.index') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

</main>
@endsection