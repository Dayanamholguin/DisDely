@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Ver usuario</strong> 
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
            <h5 class="card-title">Usuario {{$usuario->nombre}}</h5>
            <img src="/../img/{{Auth::user()->foto}}" width='80px' height='80px'>
            <p class="card-text mt-2">Apellido: {{$usuario->apellido}}</p>
            <p class="card-text">Correo: {{$usuario->email}}</p>
            <p class="card-text">Teléfono: {{$usuario->celular}}</p>
            <p class="card-text">Celular Alternativo: {{$usuario->celularAlternativo}}</p>
            <p class="card-text">Género: {{$genero}}</p>
            <p class="card-text"><a href="/usuario" class="btn btn-primary tipoletra">Volver</a></p>
            <div class="card-footer text-muted">
                <!--{{substr($usuario->created_at,0,10)}}-->
                Creado {{$usuario->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
</div>
@endsection