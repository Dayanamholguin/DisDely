@extends('layouts.auth')
@section('titulo')
Recuperar contraseña
@endsection
@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4" style="color: #B0535E">Recuperación de contraseña</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="text-center small mb-3 text-muted">Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.</div>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                                        <div class="col-md-5">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="centrado mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enviar enlace') }}
                                        </button>
                                    </div>
                            </form>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a class="titulo" href="/login">¿Ya tienes cuenta? ¡Ingresa aquí!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</div>
@endsection