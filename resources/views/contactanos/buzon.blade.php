@extends('layouts.plantilla')

@section('title', 'Contáctanos Asomavilla')

@section('content')

<main class="cuerpo">
    <div class="content_buzon">
        <div class="text_buzon">

            <img src="{!! asset('img/correo.png') !!}" alt="" width="96">

            <div class="text_img">
                <h1>TU OPINION CUENTA</h1>
                <span class="negritas">Deseamos conocer</span>
                <span>tus propuestas, </span><br>
                <span> ideas de mejora, soluciones, quejas e iniciativas.</span>
            </div>

        </div>

        <div class="form_buzon">


            <form action="{!! url('buzon') !!}" method="POST" class="formulario" onsubmit="ani()">
                @csrf
                <div class="campos">
                    <div class="content_input">
                        <input id="name" name="name" hidden value="{{ auth()->user()->name }}">
                        <input id="email" name="email" hidden value="{{ auth()->user()->email }}">
                        <input id="telf" name="telf" hidden value="{{ auth()->user()->telf }}">
                        <input id="calle" name="calle" hidden value="{{ auth()->user()->calle }}">
                        <input id="casa" name="casa" hidden value="{{ auth()->user()->casa }}">
                    </div>
                    <div id="envios" style="font-size:14px">
                        <p>enviando...</p>
                    </div>
                    <div class="buzon_alerta">
                        @if (session('info'))
                        <p>Mensaje enviado con éxito</p>
                        @endif
                    </div>

                    <div class="content_textarea">
                        <textarea id="Consulta" name="consulta" class="input_Consulta" required="" autofocus></textarea>
                    </div>
                    <div class="base_buzon">
                        <span>Solucionemos juntos los</span>
                        <span class="negritas">problemas de nuestra Comunidad.</span>
                        <span>Conocer tus sugerencias y la de otros lo hará posible.</span>
                        <span class="negritas">Haz que cuente.</span>
                    </div>

                    <div class="content_boton">
                        <button type="submit">Enviar sugerencia</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="content_contacto">
            <div class="text_contacto">
                <div>
                    <h2>Atención Personal</h2>
                </div>
                <div>
                    <p class="negritas">Urbanización Villa Heroica</p>
                    <p>Avenida Intercomunal Guarenas - Guatire</p>
                    <p>+58 426-5154181</p>
                </div>
            </div>
        </div>



    </div>



</main>






@endsection