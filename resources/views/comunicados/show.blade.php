@extends('layouts.plantilla')

@section('title', 'Comunicados Mostrar')

@section('content')

<main class="cuerpo">
    <div class="contenedor_ppal">

        <div class="present">
            <img src="{!! asset('img/comu.png') !!}" alt="logo gastos" width="72">
            <h1>COMUNICADOS</h1>
        </div>
        <div class="content_ft">
            <div class='titlenoticias'>
                <p>En esta sección encontrará todas las noticias relacionadas con la comunidad.
                    Visualice e imprima.</p>
            </div>
            <div class='noticias'>
                <ul>
                    @foreach ($comunicados as $comunicado)
                    <li>
                        <div class='imgnoticias'>
                            <img src="{!! asset('img/averc.png') !!}" alt="" width="32">
                        </div>
                        <div>
                            <p>DOC Nº. {{$comunicado->id}}-{{$comunicado->fecha}}</p>
                            <a href="{{route('create-pdf', $comunicado)}}" target="_blank">{{$comunicado->encabezado}}</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
                <div class="paginador">
                    {{ $comunicados->links() }}
                </div>
                
            </div>
        </div>
    </div>
</main>


@endsection