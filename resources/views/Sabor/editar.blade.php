@extends('layouts.app')

@section('title')
Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Modificar sabor</strong> / <a href="/sabor" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form action="/sabor/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$sabor->id}}" />
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input value="{{$sabor->nombre}}" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

 