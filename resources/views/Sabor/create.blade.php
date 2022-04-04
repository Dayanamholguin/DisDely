@extends('layouts.app')

@section('title')
Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Crear Sabor</strong>
    </div>
    <div class="card-body">
    @include('flash::message')
        <form id="form" action="/sabor/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="/sabor" type="submit" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

 