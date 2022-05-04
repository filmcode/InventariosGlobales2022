@can('crear-producto')
<form action="/">
    <label for="date_de">De: 
        <input type="date" name="" id="dateDe">
    </label>
    <label for="date_a">A: 
        <input type="date" name="" id="dateA">
    </label>
    <input type="submit" id="filterSearch" class="btn btn-primary" value="Buscar">
</form>
@endcan
<div class="col-sm-12" style="overflow: auto">
<table id="excel" class="table table-striped table-bordered nowrap shadow-lg mt-4" style="width: 100%">
<thead class="text-white" style="background-color: #0D497F">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Línea</th>
        <th scope="col">Intercambio</th>
        <th scope="col">Fecha</th>
    </tr>  
</thead>    
<tbody id=resultFilter>
    @foreach ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->linea}}</td>
        <td>{{$product->intercambio}}</td>
        <td>{{$product->created_at}}</td>
    </tr>
    @endforeach   
</tbody>  
        
</table>   
</div>
<div>
</div>
<div class="modal modal--close" id="modal">
    <div class="modal__btn" id="modalBtn">×</div>
        <div class="slider">
            <div class="slider__content" id="sliderContent"></div>
        <div class="slider__btn slider__btn--left" id="sliderButtonLeft">&#60;</div>
        <div class="slider__btn slider__btn--right" id="sliderButtonRight">&#62;</div>
        </div>
</div>
<script>
    'use strict';

    
</script>