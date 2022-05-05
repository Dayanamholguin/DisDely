@extends('layouts.menu')
@section('titulo')
Detalle Producto
@endsection
@section('content')

<div class="card-body">
    <div class="card text-center">
        <div class="card-header text-center">
            <a href="/productos" class="alert-link titulo">Volver</a>
        </div>
        <div class="card-body">
        <a href="/productos" class="alert-link titulo">Volver</a>
            <img src="/imagenes/{{$productos->img}}" width="350" height="300" style="margin: 15px;">
            
            <div style="display:inline-block;vertical-align:top">
                <strong>
                    <p class="card-title">{{$productos->nombre}}</p>
                </strong>
                <p class="card-text">Categoria: {{$categoria}}</p>
                <p class="card-text">Sabor: {{$sabor}}</p>
                <p class="card-text">Etapa: {{$etapa}}</p>
                <p class="card-text">Descripción: {{$productos->descripcion}}</p>
                <p class="card-text">Número de Personas: {{$productos->numeroPersonas}}</p>
                <p class="card-text">Número de Pisos: {{$productos->pisos}}</p>

                <a href="#" class="btn boton my-2">¡Haz tu cotización ya!</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection