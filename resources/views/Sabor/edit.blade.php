@extends('layouts.app')

@section('title')
Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Editar Sabor</strong>
    </div>
    <div class="card-body">
    @include('flash::message')
        <form action="/sabor/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$sabor->id}}" />
            <div class="row">
                <div class="col-6">
                    <div class="group">
                        <label for="">Nombre</label>
                        <input value="{{$sabor->nombre}}" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-warning">Modificar</button>
            <a href="/sabor" type="submit" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

 