@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar producto</strong> / <a href="/producto" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/producto/actualizar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$producto->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                    <img src="/imagenes/{{$producto->img}}" class="imagen" width='180px' height='150px'>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="img" id="imagen">
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Categoría</label>
                        <select class="form-control" name="categoria">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                            <option {{$value->id == $producto->idCategoria ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('categorias')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Sabor</label>
                        <select class="form-control" name="sabor">
                            <option value="">Seleccione</option>
                            @foreach($sabores as $key => $value)
                            <option {{$value->id == $producto->idSabor ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('sabores')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Género</label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option {{$value->id == $producto->idGenero ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('generos')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Etapa</label>
                        <select class="form-control" name="etapa">
                            <option value="">Seleccione</option>
                            @foreach($etapas as $key => $value)
                            <option {{$value->id == $producto->idEtapa ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('etapas')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input value="{{$producto->nombre}}" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea value="{{$producto->descripcion}}" type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required>{{ucfirst($producto->descripcion) }}</textarea>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Número de personas</label>
                        <input value="{{$producto->numeroPersonas}}" type="number" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Pisos</label>
                        <input value="{{$producto->pisos}}" type="number" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check">
                        <label for="">¿Desea añadirlo al catálogo?</label>
                        <div class="form-check ">
                            <input value="{{$producto->catalogo}}" type="radio" class="form-check-input @error('catalogo') is-invalid @enderror" id="catalogo" name="catalogo" value="1" checked required>
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
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection