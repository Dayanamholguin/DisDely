@extends('layouts.app')

@section('title')
Producto
@endsection

@section('content')

<div class="container rounded bg-white  ">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img src="/imagenes/{{$producto->img}}" alt="Admin" class="rounded-circle mt-4" width='200px' height='200px'>
                    <div class="mt-3">
                        <h4>{{$producto->nombre}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="centrado">
                <strong>Detalle del producto</strong>
            </div>
            <hr>
            <p class="card-text">Categoría: {{$categoria}}</p>
            <p class="card-text">Sabor: {{$sabor}}</p>
            <p class="card-text">Etapa: {{$etapa}}</p>
            <p class="card-text">Descripción: {{$producto->descripcion}}</p>
            <p class="card-text">Número de Personas: {{$producto->numeroPersonas}}</p>
            <p class="card-text">Número de Pisos: {{$producto->pisos}}</p>
            <div class="centrado mb-3">
                <a href="/producto/catalogo" class="btn btn-primary">Volver</a>
                <a href="/cotizacion/crear/{{ $producto->id}}" class="btn btn-primary">Realizar cotización</a>   
            </div>
        </div>
    </div>
</div>
@endsection