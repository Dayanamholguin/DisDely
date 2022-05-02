@extends('layouts.app')

@section('title')
Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear sabor</strong> / <a href="/sabor" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/sabor/guardar" method="post">
            @csrf
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ingrese el sabor" required>
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
 