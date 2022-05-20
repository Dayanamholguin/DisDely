@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar Usuario</strong> 
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/usuario/actualizar/{{$usuario->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$usuario->id}}" />
            <div class="row">
                <!--<div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <img src="/imagenes/{{$usuario->img}}" class="imagen" width='180px' height='150px'>
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
                </div> -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<b style="color: red"> *</b></label>
                        <input value="{{$usuario->nombre}}" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<b style="color: red"> *</b></label>
                        <input value="{{$usuario->apellido}}" type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" required>
                        @error('apellido')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<b style="color: red"> *</b></label>
                        <input value="{{$usuario->email}}" type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="celular">Teléfono celular<b style="color: red"> *</b></label>
                        <input value="{{$usuario->celular}}" type="number" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" required>
                        @error('celular')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celularAlternativo">Celular alternativo<b style="color: red"> *</b></label>
                        <input value="{{$usuario->celularAlternativo}}" type="number" class="form-control @error('celularAlternativo') is-invalid @enderror" id="celularAlternativo" name="celularAlternativo" required>
                        @error('celularAlternativo')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Género<b style="color: red"> *</b></label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option {{$value->id == $usuario->idGenero ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                            @endforeach
                            @error('generos')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection