@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Ver producto</strong> / <a href="/producto" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <div class="card text-center">
            <div class="card-header">
                Visualizar producto
            </div>
            <div class="card-body">
                <h5 class="card-title">Producto {{$producto->nombre}}</h5>
                <img src="/imagenes/{{$producto->img}}" width='auto' height='auto'>;
                <p class="card-text">Categoria: {{$categoria}}</p>
                <p class="card-text">Sabor: {{$sabor}}</p>
                <p class="card-text">Género: {{$genero}}</p>
                <p class="card-text">Etapa: {{$etapa}}</p>
                <p class="card-text">{{$producto->descripcion}}</p>
                <p class="card-text">{{$producto->numeroPersonas}}</p>
                <p class="card-text">{{$producto->pisos}}</p>
                @if($producto->catalogo==1)
                <p class="card-text">Está en el catálogo</p>
                @elseif($producto->catalogo==0)
                <p class="card-text">No está en el catálogo</p>
                @endif
                <a href="#" class="btn btn-primary">¡Haz tu pedido ya!</a>
            </div>
            <div class="card-footer text-muted">
                <!--{{substr($producto->created_at,0,10)}}-->
                Creado {{$producto->created_at->diffForHumans()}}
            </div>
        </div>

        
    </div>
</div>
@endsection

 