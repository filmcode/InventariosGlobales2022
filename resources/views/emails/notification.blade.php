<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ford Plasencia - {{auth()->user()->name}}</h1>
    <ul style="list-style-type: none;">
        <li> <span style="font-weight: bold;">ID:</span> {{$dataCars['id']}}</li>
        <li> <span style="font-weight: bold;">Fecha:</span> {{$dataCars['created_at']}}</li>
        <li> <span style="font-weight: bold;">Línea:</span> {{$dataCars['linea']}}</li>
        <li> <span style="font-weight: bold;">Intercambio:</span> {{$dataCars['intercambio']}}</li>
        <li> <span style="font-weight: bold;">Catálogo:</span> {{$dataCars['catalogo']}}</li>
        <li> <span style="font-weight: bold;">Modelo: </span> {{$dataCars['modelo']}}</li>
        <li> <span style="font-weight: bold;">Serie:</span> {{$dataCars['serie']}}</li>
        <li> <span style="font-weight: bold;">Color:</span> {{$dataCars['color']}}</li>
        <li> <span style="font-weight: bold;">Ubicación:</span> {{$dataCars['ubicacion']}}</li>
        <li> <span style="font-weight: bold;">Costo:</span> {{$dataCars['costo']}}</li>
        <li> <span style="font-weight: bold;">Observaciónes:</span> {{$dataCars['observaciones']}}</li>
        <li> <span style="font-weight: bold;">Apartado:</span> {{$dataCars['apartado']}}</li>
        <li> <span style="font-weight: bold;">Estatus:</span> {{$dataCars['estatus']}}</li>  
    </ul>
</body>
</html>