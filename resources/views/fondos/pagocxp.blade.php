@extends('layouts.plantilla')

@section('title', 'Pagar CxP')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/finanzc.png') !!}" alt="logo propietarios" width="72">
            <h1>PAGO CxP</h1>
        </div>

        <div class="content_ft">

            <div class="content_flex">

                <div class="contenedor_form_prop">


                    <form action="{!! url('fondos-pagos-cxp') !!}" method="post">

                        @csrf

                        <div style="padding:10px">
                            <h3>Pago de Cuenta</h3>
                        </div>

                        <div class="content_input_msg" style="height:30px;color:grey">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="" autocomplete="off">
                            <br>@error('fecha')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>


                        <div class="content_input_msg" style="height:30px;color:grey">
                            <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del Egreso" value="{{$gastos->descripcion}}" readonly autocomplete="off" style="width:80%;">
                            <br>@error('descripcion')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg" style="height:30px;color:grey">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="{{$temp->facturado - $temp->pagado}}" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <input type="text" id="idgasto" name="idgasto" value="{{$gastos->id}}" hidden>
                        <input type="text" id="tipofondo" name="tipofondo" value="egreso" hidden>

                        <div>
                            <button type="submit" class="boton_form" title="Agregar">Pagar</button>
                            <a href="{{ route('gastos-proveedores') }}" class="boton_form">Cancelar</a>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

</main>
@endsection