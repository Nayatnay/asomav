@extends('layouts.plantilla')

@section('title', 'Comunicados Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/comu.png') !!}" alt="logo comunicados" width="72">
            <h1>COMUNICADOS</h1>
        </div>

        <div class="content_ft">

            <div class="propa">
                <div>
                    <h2>Comunicados</h2>
                    <p>Noticias de interés para la comunidad.</p>
                </div>
            </div>

            <div class="tope">

                <div class="content-form-buscar" id="formBuscar">
                    <form action="{{ route('comunicados.index') }}" class="form-container">
                        <input type="search" placeholder="Buscar en la lista" name="buscar" value="{{ $buscar }}">
                        <button type="submit" class="butbuscar">Buscar</button>
                    </form>
                </div>

                <div class="botagre">
                    <a href="{{route('comunicados.create')}}">Nuevo Comunicado</a>
                </div>
            </div>

            <div class="cent">
                <div class="contenedor_littletabla">

                    <table class="tabla">
                        <tr class="table_header" style="text-align:center">
                            
                        </tr>

                        @if(count($comunicados)<=0) <tr>
                            <td colspan="3" class="negritas">No hay resultados</td>
                            </tr>
                            @else
                            @foreach ($comunicados as $comunicado)

                            <tr class="table_item">
                                <td style="min-width:150px ;">Doc. Nº {{ $comunicado->id }}-{{ $comunicado->fecha }}</td>
                                <td style="min-width:350px;text-align:left">{{ $comunicado->encabezado}}</td>
                                <td class="ver"><a href="{{route('comunicados.edit', $comunicado)}}"><img src="{!! asset('img/eyeW.png') !!}" alt="logo edición" width="24" title="Ver"></a></td>

                            </tr>
                            @endforeach
                            @endif
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</main>

@endsection