@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Ver usuario</strong> / <a href="/usuario" class="alert-link titulo">Volver</a>
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
                Visualizar usuarios
            </div>
            <div class="card-body">
                <h5 class="card-title">Usuario {{$usuario->nombre}}</h5>
                <img src="/imagenes/{{$usuario->img}}" width='auto' height='auto'>;
                <p class="card-text">Apellido: {{$usuario->apellido}}</p>
                <p class="card-text">Correo: {{$usuario->email}}</p>
                <p class="card-text">Teléfono: {{$usuario->celular}}</p>
                <p class="card-text">Celular Alternativo: {{$usuario->celularAlternativo}}</p>
                <p class="card-text">Fecha de Nacimiento: {{$usuario->fechaNacimiento}}</p>
                <p class="card-text">Género: {{$genero}}</p>
            </div>
            <div class="card-footer text-muted">
                <!--{{substr($usuario->created_at,0,10)}}-->
                Creado {{$usuario->created_at->diffForHumans()}}
            </div>
        </div>

        
    </div>
</div>
@endsection

 