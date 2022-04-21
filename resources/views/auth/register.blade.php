@extends('layouts.auth')
@section('titulo')
Registrar - DisDely
@endsection
@section('content')
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main class="mb-3 mt-3">
                    <div class="container" >
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg ">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color: #B0535E">Crear Cuenta</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <label for="nombre"><b>Nombre</b></label>
                                                        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" placeholder="Ingrese su nombre" />
                                                        
                                                            @error('nombre')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <label for="apellido"><b>Apellido</b></label>
                                                        <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}" class="form-control @error('apellido') is-invalid @enderror" name="apellido" required autocomplete="apellido" placeholder="Ingrese su apellido" />
                                                        
                                                            @error('apellido')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <label for="email"><b>Correo</b></label>
                                                        <input id="email" type="email"  value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Ingrese su correo electrónico" />
                                                        
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <label for="celular"><b>Teléfono celular</b></label>
                                                        <input id="celular" type="text" name="celular" value="{{ old('celular') }}" class="form-control @error('celular') is-invalid @enderror" name="celular" required autocomplete="celular" placeholder="Ingrese su teléfono o celular" />
                                                        
                                                            @error('celular')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <label for="celularAlternativo"><b>Celular alternativo</b></label>
                                                        <input id="celularAlternativo" type="text" name="celularAlternativo" value="{{ old('celularAlternativo') }}" class="form-control @error('celularAlternativo') is-invalid @enderror" name="celularAlternativo" required autocomplete="celularAlternativo" placeholder="Ingrese su teléfono alternativo" />
                                                       
                                                            @error('celularAlternativo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <label for="fechaNacimiento"><b>Fecha nacimiento</b></label>
                                                        <input id="fechaNacimiento" type="date" value="{{ old('fechaNacimiento') }}" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" required autocomplete="fechaNacimiento"/>
                                                       
                                                            @error('fechaNacimiento')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for=""><b>Género</b></label>
                                                        <select class="form-control" name="genero">
                                                            <option value="2">Masculino</option>
                                                            <option value="3">Femenino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <label for=""><b>Contraseña</b></label>
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
                                            <button type="submit"  class="btn btn-primary btn-user btn-block">
                                                {{ __('Registrar') }}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/login" style="color: #B0535E">¿Ya tienes una cuenta? Inicia sesión</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
@endsection
