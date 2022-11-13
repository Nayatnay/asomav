@extends('layouts.plantilla')

@section('title', 'Finanzas Editar')

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


                    <form action="{{route('fondos.update', $fondo)}}" method="post">

                        @csrf
                        @method('put')

                        <div class="content_input_msg">
                            <label for="fecha">Fecha</label><br>
                            <input type="date" name="fecha" id="fecha" value="{{old('fecha', $fondo->fecha)}}" autocomplete="off">
                            <br>@error('fecha')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        <div class="content_input_msg">
                            <label for="descripcion">Descripcion</label><br>
                            <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion cargo/abono" value="{{old('descripcion', $fondo->descripcion)}}" autocomplete="off" style="width: 100%;">
                            <br>@error('descripcion')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>

                        @if ($fondo->cargo == 0)
                        <div class="tipofondo">
                            <input type="radio" id="cargo" name="tipofondo" value="cargo">
                            <label for="cargo" style="font-size:14px;font-weight:bold;color:#2b5f00">Cargo</label>
                            <input type="radio" id="abono" name="tipofondo" value="abono" checked>
                            <label for="abono" style="font-size:14px;font-weight:bold;color:#2b5f00">Abono</label>
                        </div>
                        <div class="content_input_msg">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="{{old('abono', $fondo->abono)}}" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>
                        @else
                        <div class="tipofondo">
                            <input type="radio" id="cargo" name="tipofondo" value="cargo" checked>
                            <label for="cargo" style="font-size:14px;font-weight:bold;color:#2b5f00">Cargo</label>
                            <input type="radio" id="abono" name="tipofondo" value="abono">
                            <label for="abono" style="font-size:14px;font-weight:bold;color:#2b5f00">Abono</label>
                        </div>
                        <div class="content_input_msg">
                            <label for="cargo">Monto</label>
                            <input type="number" name="monto" class="numberM" id="monto" min="1" max="99999.99" step="any" value="{{old('cargo', $fondo->cargo)}}" autocomplete="off" style="text-align:right">
                            @error('monto')
                            <small>*{{$message}}</small>
                            @enderror
                        </div>
                        @endif

                        <input type="text" name="restriccion" value="0" hidden>

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