<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón de Sugerencias</title>
</head>
<body>
    <h1>BUZON DE SUGERENCIAS</h1>
    <p><strong>Propietario:</strong> {{$sugerencia['name']}} </p>
    <p><strong>Email:</strong> {{$sugerencia['email']}} </p>
    <p><strong>Teléfono:</strong> {{$sugerencia['telf']}} </p>
    <p><strong>Calle:</strong> {{$sugerencia['calle']}} </p>
    <p><strong>Casa:</strong> {{$sugerencia['casa']}} </p>
    <p><strong>Mensaje:</strong> {{$sugerencia['consulta']}} </p>
</body>
</html>