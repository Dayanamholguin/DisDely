<!DOCTYPE html>
<html lang="es" style="background: #B0535E">
    <head>
        <meta charset="utf-8" />
        <title>Restablecer contraseña</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png" />
        <link href="/css/sb-admin-2.css" rel="stylesheet" />
        <link href="/css/style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main style="background-color: #B0535E">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <img class="imagen my-4" src="/img/logo.png" width="100px" height="100px" alt="Dulce Encanto">
                                    <h3 class="text-center font-weight-light " style="color: #B0535E">Dulce Encanto</h3>
                                    <div class="card-header text-center">{{ __('Reset Password') }}</div>
                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf

                                                <div class="row mb-3">
                                                    <label for="email" class="col-md-12 col-form-label text-md-end text-center">Digite su correo electrónico</label>

                                                    <div class="col-md-12">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-0">
                                                    <div class="col-md-12 offset-md-12 centrado">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Send Password Reset Link') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/sb-admin-2.js"></script>
    </body>
</html>