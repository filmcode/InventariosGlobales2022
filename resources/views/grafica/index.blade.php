@extends('adminlte::page')

@section('title', 'Ford | Grafica')

@section('content_header')
    <h1>Graficas</h1>
@stop
@section('content')
<x-app-layout>
    <form action="/ajaxGrafica" method="POST"  id="selectForm">
        {{ csrf_field() }}
        <select id="statusGrafica" value="searchCarros" style="margin-bottom: 20px;">
            <option value="searchCarros">Estadistica por usuario</option>
            <option value="status">Estados</option>
            <option value="intercambio">Intercambio</option>
        </select>
    </form>
    <div id="result">    
        <canvas id="myChart" class="mychart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="/js/grafica.js"></script>
</x-app-layout>
@stop