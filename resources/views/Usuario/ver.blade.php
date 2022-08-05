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
                        <h4>Usuario <br> {{$usuario->nombre. " ".$usuario->apellido}}</h4>
                        <!--{{substr($usuario->created_at,0,10)}}-->
                        
                        <p class="text-muted">Creado {{$usuario->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3 ">
            <div class="centrado">
                <strong>Ver Información del usuario</strong>
            </div>
            <hr>
            <div class="p-2 text-center">
                <p class="card-text mt-2">Nombre: {{$usuario->nombre}}</p>
                <p class="card-text mt-2">Apellido: {{$usuario->apellido}}</p>
                <p class="card-text">Correo: {{$usuario->email}}</p>
                <p class="card-text">Teléfono: {{$usuario->celular}}</p>
                <p class="card-text">Celular Alternativo: {{$usuario->celularAlternativo}}</p>
                <p class="card-text">Género: {{$genero}}</p>
            </div>
            <div class="d-flex justify-content-center align-items-end mb-3" style="margin-top: 100px">
                @if (strpos(url()->previous(), "/pedido/ver/"))
                    <a href="{{url()->previous()}}" class="titulo alert-link">Volver</a></p>
                @else
                <a href="/usuario" class="titulo alert-link">Volver</a></p>
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection