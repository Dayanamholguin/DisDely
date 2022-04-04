@extends('layouts.app')

@section('title')
Categorías
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Crear categoria</strong>
    </div>
    <div class="card-body">
        <form id="form" action="/categoria/guardar" method="post">
            @csrf
            <!--    PONER FORMATO IMAGEN
                <div class="row">
                <div class="col-6">
                    <div class="group">
                        <label for="">Imagen</label>
                        <input type="blob" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" required>
                    </div>
                </div>
            </div>-->
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
            <a href="/categoria" type="submit" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

 