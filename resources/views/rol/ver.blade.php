@extends('layouts.app')

@section('title')
Rol
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Ver rol</strong> / <a href="/rol" class="alert-link titulo">Volver</a>
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
                Visualizar rol - {{$roles->name}}
            </div>
            <div class="card-body">
                @foreach ($rolPermisos as $value)
                    <div class="alert alert-secondary" role="alert">
                        {{$value->description}}
                    </div>
                @endforeach
            </div>
        </div>        
    </div>
</div>
@endsection

 