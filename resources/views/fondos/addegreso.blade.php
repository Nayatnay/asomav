@extends('layouts.plantilla')

@section('title', 'Finanzas Egresos')

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


                    <form action="{!! url('fondos') !!}" method="post">

                        @csrf
                        
                        <div style="padding:10px">
                            <h3>Egreso de Cuenta</h3>
                        </div>

                        <div class="content_input_msg" style="height:30px;color:grey">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" autocomplete="off">
                            <br>@error('fecha')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg" style="height:30px;color:grey">
                            <select name="gastoid" id="gastoid" style="color:grey;font-size:12px;padding:5px;border:1px solid grey" onchange="llenar(this.options)">
                                <option>Seleccione Servicio o Proveedor</option>;
                                @foreach ($gastos as $gasto)
                                <option value="{{$gasto->id}}" title="Gastos">{{$gasto->descripcion}}</option>;
                                @endforeach
                            </select>
                            <div class="content_input_msg" style="height:30px;color:grey">
                                <input style="display:none;width: 100%" type="text" name="descripcion" id="descripcion" placeholder="Descripcion del Egreso" value="{{old('descripcion')}}" autocomplete="off">
                                <br>@error('descripcion')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="content_input_msg" style="height:30px">
                            <label for="chequeo" style="font-size:12px; color:green">Egreso por otro concepto</label>
                            <input type="checkbox" name="chequeo" id="chequeo" onClick="if (this.checked) ocultar(); else mostrar()">
                        </div>

                        <div class="content_input_msg" style="height:30px;color:grey">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="0.00" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <input type="text" id="tipofondo" name="tipofondo" value="egreso" hidden>

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