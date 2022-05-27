@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Ver producto</strong> 
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <h5 class="card-title">Producto {{$producto->nombre}}</h5>
            <img src="{{$producto->img=='/img/defecto.jpg'?"/img/defecto.jpg":"/imagenes/$producto->img"}}" width='200px' height='200px'>
            <p class="card-text">Categoria: {{$categoria}}</p>
            <p class="card-text">Sabor: {{$sabor}}</p>
            <p class="card-text">Etapa: {{$etapa}}</p>
            <p class="card-text">Descripción: {{$producto->descripcion}}</p>
            <p class="card-text">Número de Personas: {{$producto->numeroPersonas}}</p>
            <p class="card-text">Número de Pisos: {{$producto->pisos}}</p>
            @if($producto->catalogo==1)
            <p class="card-text">Está en el catálogo</p>
            @elseif($producto->catalogo==0)
            <p class="card-text">No está en el catálogo</p>
            @endif
            <p class="card-text"><a href="/producto" class="btn btn-primary tipoletra">Volver</a></p>
            <div class="card-footer text-muted">
                <!--{{substr($producto->created_at,0,10)}}-->
                Creado {{$producto->created_at->diffForHumans()}}
            </div>
        </div>


    </div>
</div>
@endsection