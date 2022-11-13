<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación</title>
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;width:80%;margin:auto;">
    <div style="padding:10px 0px;margin-top:50px">
        <img src="{!! asset('img/logaso.png') !!}" alt="logo Arbol" width="192">
        <p style="font-size:9px;font-weight:bold">Asociación para el mantenimiento de Villa Heroica</p>
    </div>

    <div style="color:#005500;text-align:right">
        <h4>NOTIFICACION DE COBRO</h4>
    </div>
    <div>
        <h3>Estimado(a): {{$envio['nombre']}}</h3>
        <span style="font-size:14px">Consulte el detalle de su Recibo del mes de {{ strftime("%B de %Y", strtotime( $envio->periodo ))}} en</span>
        <a href="#" style="font-weight:bold;color:#005500;font-size:14px"> Asomavilla Web</a>
        <span style="font-size:14px"> desde asomav.com.ve</span>

    </div>
    <br><br>
    <div style="padding:5px 0px;font-size:12px">
        <p style="font-weight:bold">Realice sus pagos desde su Dispositivo Móvil o a través de la Banca en Línea</p>
        <span style="color:#005500;font-weight:bold">Pago Móvil</span>
        <span>Banco: 0105 C.I. 4578090 Telf.: 0426-5154181</span><br>
        <span style="color:#005500;font-weight:bold">Depósitos de la Banca en Línea</span>
        <span>BNC 0191-0278-54-2100025206 - Asomavilla - J-30349217-7</span>
    </div>
    <br><br>
    <div style="background:linear-gradient(0deg, rgba(47,83,1,1) 0%, rgba(96,149,0,1) 100%);color:white;padding:5px 0px;text-align:center;">
        <h3>Reporte su pago o transferencia en nuestra WEB</h3>
    </div>

    <br>
    <div style="font-size:12px;text-align:center;margin-bottom:50px">
        <img src="{!! asset('img/dan.png') !!}" alt="logo advertencia" width="32">
        <p>Para garantizar la seguridad y confidencialidad de sus datos, esta dirección de correo electrónico es utilizada únicamente para enviar la información solicitada. Por favor no responder este mensaje.</p>
    </div>
    
    <div style="background-color:lightgrey;padding:5px 0px;font-size:10px;font-weight:bold;text-align:center">
        <p>Contactarnos al 0212 600.24.24 0212 503.24.24</p>
    </div>
</body>

</html>