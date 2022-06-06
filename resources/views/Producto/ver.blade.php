@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="container rounded bg-white  ">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img src="{{$producto->img=='/img/defecto.jpg'?"/img/defecto.jpg":"/imagenes/$producto->img"}}" class="rounded-circle mt-4" width='200px' height='200px'>
                    <div class="mt-3">
                        <h4>Producto {{$producto->nombre}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="centrado">
                <strong>Ver producto</strong>
            </div>
            <hr>
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
            <div class="centrado mb-3">
                <a href="/producto" class="btn btn-primary">Volver</a></p>
            </div>
            <div class="card-footer text-muted text-center w3-panel w3-border w3-border-green">
                <!--{{substr($producto->created_at,0,10)}}-->
                Creado {{$producto->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
</div>
@endsection