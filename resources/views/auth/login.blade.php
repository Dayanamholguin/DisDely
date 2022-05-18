@extends('layouts.auth')
@section('titulo')
Acceso - DisDely
@endsection
@section('content')
<div class="container">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4" style="color: #B0535E">Dulce Encanto</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="user-details">
                                        <div class="form-floating mb-3">
                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-floating mb-3">
                                                <button type="submit" style="background-color:white;" class="col-md-12 btn btn-primary">
                                                    {{ __('Iniciar sesión') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                <a class=" col-md-12 btn btn-link" style="color: #B0535E" href="{{ route('password.request') }}">
                                                    {{ __('Olvidé mi contraseña') }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="/register" style="color: #B0535E">¿No tienes una cuenta? Ingresa aquí</a></div>
                                <div class="small"><a aria-current="page" href="/" style="color: #B0535E">Volver a la página</a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>
@endsection