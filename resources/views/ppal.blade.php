@extends('layouts.plantilla')

@section('title', 'Principal Asomavilla')

@section('content')

<main class="cuerpo">

    <div class="content_welcome">
        <div class="text">
            <h1>BIENVENIDO A NUESTRA WEB</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum voluptates sequi molestias hic? Veritatis ratione consequuntur aperiam eius porro voluptatibus suscipit quis amet vel explicabo, quibusdam itaque praesentium sunt quia.</p>
            <a href="{!! asset('buzon') !!}">Buzón de sugerencias</a>
        </div>
        <div class="image">

        </div>
    </div>

</main>

@endsection