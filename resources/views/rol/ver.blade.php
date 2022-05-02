@extends('layouts.app')

@section('title')
Rol
@endsection

@section('content')
<div class="container">
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
                    Visualizar Permisos - {{$roles->name}}
                </div>
                <div class="col-md-12 col-sm-3">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($rolPermisos as $value)
                            <div class="alert alert-link titulo" role="alert">
                                <ul>
                                    <li>
                                        {{$value->description}}
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection