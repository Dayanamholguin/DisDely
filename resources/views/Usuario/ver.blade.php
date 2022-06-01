@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="container rounded bg-white  ">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img src="/../img/{{$usuario->foto}}" class="rounded-circle mt-4" width='150px' height='150px'>
                    <div class="mt-3">
                        <h4>Usuario {{$usuario->nombre}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="centrado">
                <strong>Ver usuario</strong>
            </div>
            <hr>
            <p class="card-text mt-2">Apellido: {{$usuario->apellido}}</p>
            <p class="card-text">Correo: {{$usuario->email}}</p>
            <p class="card-text">Teléfono: {{$usuario->celular}}</p>
            <p class="card-text">Celular Alternativo: {{$usuario->celularAlternativo}}</p>
            <p class="card-text">Género: {{$genero}}</p>
            <div class="centrado mb-3">
                <a href="/usuario" class="btn btn-primary">Volver</a></p>
            </div>
            <div class="card-footer text-muted text-center w3-panel w3-border w3-border-green">
                <!--{{substr($usuario->created_at,0,10)}}-->
                Creado {{$usuario->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
</div>
@endsection