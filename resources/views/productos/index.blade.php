@extends('adminlte::page')

@section('title', 'Ford | Busquedas')


@section('content_header')
    <h1>Busqueda de carros</h1>
@stop

@section('content')

<x-app-layout>

            @can('crear-busqueda')
            <div class="d-flex justify-content-between">
                <a type="button" href="{{ route('productos.create') }}" class="btn bg-primary mb-4">Crear</a>
                <form action="/productos">
                    <label for="date_de">De: 
                        <input type="date" name="dateDe" id="dateDe" value="{{$date['dateDe']}}">
                    </label>
                    <label for="date_a">A: 
                        <input type="date" name="dateA" id="dateA" value="{{$date['dateA']}}">
                    </label>
                    <input type="submit" id="filterSearch" class="btn btn-primary" value="Buscar">
                </form>
            </div>
            @endcan
            <div class="col-sm-12" style="overflow: auto">
            <table id="excel" class="table table-striped table-bordered nowrap shadow-lg mt-4" style="width: 100%">
                <thead class="text-white" style="background-color: #0D497F">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Línea</th>
                        <th scope="col">Intercambio</th>
                        <th scope="col">Catálogo</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Serie</th>
                        <th scope="col">Color</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Observaciónes</th>
                        <th scope="col">Apartado</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>  
                </thead>    
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->linea}}</td>
                        <td>{{$product->intercambio}}</td>
                        <td>{{$product->catalogo}}</td>
                        <td>{{$product->modelo}}</td>
                        <td>{{$product->serie}}</td>
                        <td>{{$product->color}}</td>
                        <td>{{$product->ubicacion}}</td>
                        <td>{{$product->costo}}</td>
                        <td>{{$product->observaciones}}</td>
                        <td>{{$product->apartado}}</td>
                        <td>{{$product->estatus}}</td>    
                        <td  class="border px-14 py-1">
                            @php
                                $images = array();
                            @endphp
                            @foreach($productsImages as $image)
                                @if($product->id == $image->product_id)
                                @php
                                $images[] = '/img/' . $image->name;
                                @endphp
                                @endif
                            @endforeach
                            @if (substr($images[0],strlen($images[0]) -3) == 'pdf')
                            <img src="/img/pdf.png" data-images="{{implode(',',$images)}}" style="cursor: pointer;height:80px;width:80px;border-radius: 5px;">
                            @else
                            <img src="{{$images[0]}}" data-images="{{implode(',',$images)}}" style="cursor: pointer;height:80px;width:80px;border-radius: 5px;">
                            @endif  
                        </td>                        
                        <td class="border px-4 py-2">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <!-- botón editar -->
                                @can('editar-busqueda')
                                <a href="{{ route('productos.edit', $product->id) }}" class="rounded btn btn-info text-white font-bold mr-2">Editar</a>
                                @endcan
                                <!-- botón borrar -->
                                <form action="{{ route('productos.destroy', $product->id) }}" method="POST" class="formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    @can('borrar-busqueda')
                                    <button type="submit" class="rounded btn btn-danger text-white font-bold">Borrar</button>
                                    @endcan
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>  
                     
            </table>   
            </div>
                <div>
                {!! $products->links() !!}
                </div>
                <div class="modal modal--close" id="modal">
                    <div class="modal__btn" id="modalBtn">×</div>
                     <div class="slider">
                         <div class="slider__content" id="sliderContent"></div>
                        <div class="slider__btn slider__btn--left" id="sliderButtonLeft">&#60;</div>
                        <div class="slider__btn slider__btn--right" id="sliderButtonRight">&#62;</div>
                     </div>
                </div>
</x-app-layout>

@stop

@section('css')
    <link rel="stylesheet" href="/css/modal.css">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
@stop   

@section('js')
    <script src="/js/previewProductsImages.js"></script>
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

    <script>
    (function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {        
          event.preventDefault()
          event.stopPropagation()        
          Swal.fire({
                title: '¿Confirma la eliminación del registro?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                }
            })                      
      }, false)
    })
})()
</script>
@stop
