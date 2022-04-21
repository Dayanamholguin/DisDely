
@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Usuario</strong> / <a href="/usuario" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/usuario/guardar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" placeholder="Ingrese su nombre" />
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido"><b>Apellido</b></label>
                            <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}" class="form-control @error('apellido') is-invalid @enderror" name="apellido" required autocomplete="apellido" placeholder="Ingrese su apellido" />
                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email"><b>Correo</b></label>
                            <input id="email" type="email"  value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Ingrese su correo electrónico" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celular">Teléfono celular</label>
                            <input id="celular" type="text" name="celular" value="{{ old('celular') }}" class="form-control @error('celular') is-invalid @enderror" name="celular" required autocomplete="celular" placeholder="Ingrese su teléfono o celular" />
                            @error('celular')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celularAlternativo">Celular alternativo</label>
                            <input id="celularAlternativo" type="text" name="celularAlternativo" value="{{ old('celularAlternativo') }}" class="form-control @error('celularAlternativo') is-invalid @enderror" name="celularAlternativo" required autocomplete="celularAlternativo" placeholder="Ingrese su teléfono alternativo" />
                                @error('celularAlternativo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="fechaNacimiento"><b>Fecha nacimiento</b></label>
                            <input id="fechaNacimiento" type="date" value="{{ old('fechaNacimiento') }}" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" required autocomplete="fechaNacimiento"/>
                            @error('fechaNacimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                        <label for="">Contraseña</label>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Contraseña" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repita la contraseña" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
