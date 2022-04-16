@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear producto</strong> / <a href="/producto" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/producto/guardar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                        @error('imagen')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria">
                            @foreach($categorias as $key => $value)
                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Sabor</label>
                        <select class="form-control" name="sabor">
                            @foreach($sabores as $key => $value)
                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Género</label>
                        <select class="form-control" name="genero">
                            @foreach($generos as $key => $value)
                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Etapa</label>
                        <select class="form-control" name="etapa">
                            @foreach($etapas as $key => $value)
                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                        @error('nombre')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required></textarea>
                        @error('descripcion')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Número de personas</label>
                        <input type="number" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" required>
                        @error('numeroPersonas')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Pisos</label>
                        <input type="number" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" required>
                        @error('pisos')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check">
                        <label for="">¿Desea añadirlo al catálogo?</label>
                        <div class="form-check ">
                            <input class="form-check-input @error('catalogo') is-invalid @enderror" type="radio" value="1" name="catalogo" id="catalogo" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Sí
                            </label>
                            @error('catalogo')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('catalogo') is-invalid @enderror" type="radio" value="0" name="catalogo" id="catalogo">
                            <label class="form-check-label" for="flexRadioDefault1">
                                No
                            </label>
                            @error('catalogo')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
 