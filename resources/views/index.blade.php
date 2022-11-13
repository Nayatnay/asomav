<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asomavilla</title>
    <link rel="shortcut icon" href="{!! asset('img/logo.png') !!}">
    <link rel="stylesheet" href="{!! asset('css/index.css') !!}">
    <script src="../js/master.js" defer></script>
</head>

<body>

    <div class="content_ppal">
        <!--cabecera -->

        <header class="cabecera">
            <div class="content_contenido_cabecera">
                <div class="presentacion">
                    <div class="pres1">
                        <img src="{!! asset('img/correo.png') !!}" alt="Imagen correo" width="24">
                        <span>asomavilla2009@gmail.com</span>
                    </div>
                    <div class="pres1">
                        <img src="{!! asset('img/qr.png') !!}" alt="Imagen QR" width="24">
                        <span>J-30349217-7</span>
                    </div>
                    <div class="pres1">
                        <img src="{!! asset('img/notic.png') !!}" alt="Imagen Info" width="24">
                        <span>Asociación para el mantenimiento de Villa Heroica</span>
                    </div>
                </div>
                <div class="loginpub">
                    <img src="{!! asset('img/logo2.png') !!}" alt="Logo asomavilla" width="32">
                </div>
            </div>
        </header>

        <!--Barra de navegacion -->

        <nav class="content_menu">
            <div class="menu">
                <div class="logo">
                    <img src="{!! asset('img/logo.png') !!}" alt="correo" width="32">
                    <h1>Asomavilla</h1>
                </div>
                <div class="content_nav">
                    <div class="bar_nav">
                        <a href="{!! asset('login') !!}" class="item_nav"><span>Iniciar sesión</span><img src="{!! asset('img/loginW.png') !!}" alt="correo" width="32"></a>
                    </div>
                </div>
            </div>
        </nav>

        <!--Miscelaneos: Foto y anuncio -->
        <div class="cuerpo">


            <div class="content_miscel">
                <div class="miscelaneos">
                    <div class="text_miscelaneos">
                        <h2>Asomavilla Web</h2>
                        <p>Una nueva modalidad de administración, gestión y consulta</p>
                    </div>
                </div>
            </div>

            <div class="Content_datosbanco">
                <div class="tit_datbanc">
                    <h2>INFORMACION BANCARIA</h2>
                    <p>Realiza el pago de los servicios</p>
                </div>
                <div class="desg_banc">

                    <div class="pagomd">
                        <div class="img_pmov">
                            <img src="{!! asset('img/fpmovil.png') !!}" alt="" width="56">
                        </div>
                        <div class="pagmov">
                            <h2>Desde tu dispositivo móvil</h2>
                            <span>Pago</span>
                            <span class="mvl">Móvil</span>
                            <p>Banco: 0105 C.I. 4578090 Telf.: 0426-5154181</p>
                        </div>
                    </div>

                    <div class="pagomd">
                        <div class="img_pmov">
                            <img src="{!! asset('img/banc.png') !!}" alt="" width="56">
                        </div>
                        <div class="pagmov">
                            <h2>A través de la Banca en Línea</h2>
                            <span>Con Depósitos</span>
                            <span class="mvl">BNC</span>
                            <p class="desglo"> 0191-0278-54-2100025206 - Asomavilla - J-30349217-7</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--Pie de pagina  -->
        <footer class="pie">
            <span>Copyright &copy; 2022. </span>
            <span class="tit_condomin">ASOMAVILLA. RIF. J-30349217-7.</span>
            <p>Urbanización Villa Heroica. Municipio Autónomo Ezequiel Zamora</p>
        </footer>
    </div>
</body>



</html>