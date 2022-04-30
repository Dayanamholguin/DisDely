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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                            <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('categorias')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor</label>
                        <select class="form-control" name="sabor">
                            <option value="">Seleccione</option>
                            @foreach($sabores as $key => $value)
                            <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('sabores')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Género</label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('generos')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Etapa</label>
                        <select class="form-control" name="etapa">
                            <option value="">Seleccione</option>
                            @foreach($etapas as $key => $value)
                            <option value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('etapas')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea type="text" value="{{ old('descripcion') }}" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Ingrese la descripción" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Número de personas</label>
                        <input type="number" value="{{ old('numeroPersonas') }}" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" placeholder="Ingrese número de personas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos</label>
                        <input type="number" value="{{ old('pisos') }}" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Desea añadirlo al catálogo?</label>
                            <select class="form-control" name="catalogo">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection