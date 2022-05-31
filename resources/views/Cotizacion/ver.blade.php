@extends('layouts.app')

@section('content')
<div class="container rounded bg-white  ">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @foreach($detalleCotizacion as $value)
                <img src="{{$value->img==null?'/img/defecto.jpg':'/imagenes/'.$value->img}}" class="rounded-circle mt-4" width="130" height="100" alt="{{$value->img==null?'No tiene imagen de referencia':''}}" data-toggle="tooltip" data-placement="bottom" title="{{$value->img==null?'No tiene imagen de referencia':'Foto de referencia'}}">
                    <div class="mt-3">
                        <h4>Producto {{ $value->producto}}</h4>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="centrado">
                <strong>Detalle de los productos de la cotización</strong>
            </div>
            <hr>
            @foreach($detalleCotizacion as $value)
            <p class="card-text">Número de personas: {{$value->numeroPersonas}}</p>
            <p class="card-text">Pisos: {{$value->pisos}}</p>
            <p class="card-text">Sabor: {{$value->saborDeseado}}</p>
            <p class="card-text">frase: {{$value->frase==null?'No tiene frase':$value->frase}}</p>
            <p class="card-text">Descripción: {{$value->descripcionProducto}}</p>
            <hr>
            @endforeach
            <div class="centrado mb-3">
                <a href="/cotizacion" class="btn btn-primary tipoletra">Volver</a>
            </div>
        </div>
    </div>
</div>  
@endsection