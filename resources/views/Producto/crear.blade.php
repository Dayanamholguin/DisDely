@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear producto</strong>
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
                        <label for="">Imagen<b style="color: red"> *</b></label>
                        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="form-group">
                                <label for="">Categoría<b style="color: red"> *</b></label>
                                <select class="form-control" name="categoria">
                                    <option value="">Seleccione</option>
                                    @foreach($categorias as $key => $value)
                                    <option value="{{ $value->id }}" {{old('categorias' ) == $value->id ? 'selected' : ''}}>{{ $value->nombre }}</option>
                                    @endforeach
                                    @error('categorias')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="centrado">
                                <a style="margin-top: 31px;" href="/categoria/crear" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear categoría">+</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="form-group">
                                <label for="">Sabor<b style="color: red"> *</b></label>
                                <select class="form-control" name="sabor">
                                    <option value="">Seleccione</option>
                                    @foreach($sabores as $key => $value)
                                    <option value="{{$value->id}}" {{old('sabores' ) == $value->id ? 'selected' : ''}}>{{$value->nombre}}</option>
                                    @endforeach
                                    @error('sabores')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="centrado">
                                <a style="margin-top: 31px;" href="/sabor/crear" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear categoría">+</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Etapa<b style="color: red"> *</b></label>
                        <select class="form-control" name="etapa">
                            <option value="">Seleccione</option>
                            @foreach($etapas as $key => $value)
                            <option value="{{$value->id}}" {{old('etapas' ) == $value->id ? 'selected' : ''}}>{{$value->nombre}}</option>
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
                        <label for="">Nombre<b style="color: red"> *</b></label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<b style="color: red"> *</b></label>
                        <textarea type="text" value="{{ old('descripcion') }}" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Ingrese la descripción" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Número de personas<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('numeroPersonas') }}" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" placeholder="Ingrese número de personas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('pisos') }}" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Desea añadirlo al catálogo?<b style="color: red"> *</b></label>
                        <select class="form-control" name="catalogo">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                    <a href="/producto" class="btn btn-primary tipoletra">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection