@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        Este es el detalle de los productos de la cotizacion / <a href="/cotizacion" class="titulo">Volver</a>
    </div>
    <div class="card-body">
    @include('flash::message')
        <table id="detallecotizaciones" class="table table-bordered dt-responsive dataTable text-left" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Número personas</th>
                    <th>Pisos</th>
                    <th>Sabor</th>             
                    <th>frase</th>             
                    <th>Descripción</th>             
                    <th>imagen</th>         
                </tr>
            </thead>
            <tbody>
                @foreach($detalleCotizacion as $value)
                    <tr>
                        <td>{{$value->cotizacionid}}</td>
                        <td>{{$value->producto}}</td>
                        <td>{{$value->numeroPersonas}}</td>
                        <td>{{$value->pisos}}</td>
                        <td>{{$value->saborDeseado}}</td>
                        <td>{{$value->frase==null?'No tiene frase':$value->frase}}</td>
                        <td>{{$value->descripcionProducto}}</td>
                        <td><img src="{{$value->img==null?'':'/imagenes/'.$value->img}}" alt="">{{$value->img==null?'No tiene imagen de referencia':''}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection