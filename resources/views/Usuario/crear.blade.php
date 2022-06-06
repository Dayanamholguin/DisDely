@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Usuario</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form action="/usuario/guardar" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<strong style="color: red"> *</strong></label>
                        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required 
                        autocomplete="nombre" placeholder="Ingrese su nombre" />
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<strong style="color: red"> *</strong></label>
                        <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}" class="form-control @error('apellido') is-invalid @enderror" name="apellido" 
                        required autocomplete="apellido" placeholder="Ingrese su apellido"  />
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<strong style="color: red"> *</strong></label>
                        <input id="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Ingrese su correo electrónico" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celular">Teléfono celular<strong style="color: red"> *</strong></label>
                        <input id="celular" type="number" name="celular" value="{{ old('celular') }}" class="form-control @error('celular') is-invalid @enderror" name="celular" 
                        required autocomplete="celular" placeholder="Ingrese su teléfono o celular" minlength="7" maxlength="10"/>
                        @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celularAlternativo">Celular alternativo<strong style="color: red"> *</strong></label>
                        <input id="celularAlternativo" type="number" name="celularAlternativo" value="{{ old('celularAlternativo') }}" class="form-control @error('celularAlternativo') is-invalid @enderror" name="celularAlternativo" 
                        required autocomplete="celularAlternativo" placeholder="Ingrese su teléfono alternativo" minlength="7" maxlength="10"/>
                        @error('celularAlternativo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="genero">Género<strong style="color: red"> *</strong></label>
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
                <!-- <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Contraseña<strong style="color: red"> *</strong></label>
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Contraseña" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Confirmar contraseña<b style="color: red"> *</b></label>
                        <input id="password-confirm" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repita la contraseña" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div> -->
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#nombre, #apellido, #celular, #celularAlternativo").focusout(function(event) {
            console.log();
            if ($(this).val().length > 0) {
                // $(this).addClass("is-valid").removeClass("is-invalid");
                $(this).rules('remove');
            } else {
                $(this).valid();
                $(this).addClass("is-invalid").removeClass("is-valid");
            }
        });
        $('#form').validate({
            rules: {
                nombre: {
                    required: true,
                },
                apellido: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                }
            },
        });
    });
</script>

@endsection