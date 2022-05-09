@extends('adminlte::page')

@section('title', 'Ford | Inventarios Globales')

@section('content_header')
    <h1>Listado de Carrros</h1>
@stop

@section('content')
 <div class="col-sm-12" style="overflow: auto">
    <table id="excel" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="text-white" style="background-color: #0D497F">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Agencia</th>
                <th scope="col">No_Inventario</th>
                <th scope="col">Días_Inventario</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Clave_Modelo</th>
                <th scope="col">Color_Exterior</th>
                <th scope="col">Color_Interior</th>
                <th scope="col">Transmisión</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Costo_Unidad</th>
                <th scope="col">Precio_Unidad</th>
                <th scope="col">DEMO</th>
                <th scope="col">No_Serie</th>
                <th scope="col">Nombre_Agente</th>
                <th scope="col">Estatus</th>
                <th scope="col">Observaciones</th>
            </tr>
        </thead>
        <tbody class="p-2 text-dark bg-opacity-25">    
            @foreach( $carros['data'] as  $carro)
            
            <tr>
                
                <td>{{$carro['ID']}}</td>
                <td>{{$carro['Agencia']}}</td>
                <td>{{$carro['NumerodeInventario1']}}</td>
                <td>{{$carro['DiasDeInventario']}}</td>
                <td>{{$carro['Marca']}}</td>
                <td>{{$carro['Modelo']}}</td>
                <td>{{$carro['ClaveModelo']}}</td>
                <td>{{$carro['ColorExterior']}}</td>
                <td>{{$carro['ColorInterior']}}</td>
                <td>{{$carro['Transmision']}}</td>
                <td>{{$carro['Ubicacion']}}</td>
                <td>{{$carro['CostoUnidad']}}</td>
                <td>{{$carro['PrecioUnidad']}}</td>
                <td>{{$carro['Demo']}}</td>
                <td>{{$carro['NumeroDeSerie']}}</td>
                <td>{{$carro['NombreAgente']}}</td>
                <td>
                    @php
                        $estado_resultado = 0;
                        $reservado = 0;
                    @endphp
                    @foreach( $estados as  $estado)
                        @if($carro['ID'] == $estado->id_api)
                            @if($estado_resultado < 1)
                            <!-- fecha inicio -->
                            <!-- valida si pasaron 72 horas -->
                            @php
                                    $date_start = date_create_from_format('Y-m-d H:i:s', $estado->created_at);
                                    $estado_resultado = $CarroController->Horas($date_start);
                                    $reservado =  $CarroController->Horas($date_start, 2);
                                @endphp
                            @endif
                        @endif
                    @endforeach
                    <!-- Mostrar respuesta -->
                    @if($estado_resultado)
                    Reservado aproximandamente {{$reservado}}
                    @else
                        <select name="estado" data-id="{{$carro['ID']}}">
                                    <option value="0">Libre</option>
                                    <option value="1">Reservado</option>
                        </select>
                    @endif
                </td>
                <td class="text-center">{{$carro['Observaciones']}}
                    @php
                        $observaciones_resultado = 0;
                    @endphp
                    @foreach($observaciones as  $observacion)
                        @if($carro['ID'] == $observacion->id_api)
                            @if(!$observaciones_resultado)
                                <!-- valida si pasaron 72 horas -->
                                @php
                                    if($observacion->descripcion) {
                                        $observaciones_resultado = $observacion->descripcion;
                                    } else {
                                        $observaciones_resultado = '';
                                    }
                                @endphp
                            @endif
                        @endif
                    @endforeach
                    @if($observaciones_resultado != 0)
                    <a href="/observaciones/{{$carro['ID']}}"  class="rounded btn btn-warning text-white font-bold mr-2">Editar</a><br>
                    <p>
                       {{$observaciones_resultado}}
                    </p>
                    @else
                        <a href="/observaciones/{{$carro['ID']}}" class="rounded btn btn-info text-white font-bold mr-2">Agregar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/js/reservar.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#excel').DataTable({
                dom: "Bfrtip",
                buttons:{
                    dom:{
                        button:{
                            className: 'btn'
                        }
                    },
                    buttons:[
                        {
                            extend:"excel",
                            text:'Excell',
                            className: 'btn btn-outline-success',
                            excelStyles:{
                                template:'header_blue'
                            }
                        }
                    ]
                }
            });
        } );
    </script>
@stop