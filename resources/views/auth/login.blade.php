<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Acceso - DisDely</title>
    <link href="/css/sb-admin-2.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <style>
        body {
            width: 100%;
            height: 100vh;
            background: linear-gradient(45deg, blue, pink, yellow, white);
            background-size: 400% 400%;
            position: relative;
        }
    </style>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4" style="color: #B0535E">Dulce Encanto</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
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

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Recuerdame') }}
                                            </label>
                                        </div>

                                        <div>
                                            <div class="form-floating mb-3">
<<<<<<< HEAD
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

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Recuerdame') }}
                                                </label>
                                            </div>

                                            <div >
                                                <div class="form-floating mb-3">
                                                    <button type="submit" style="background-color:white; color:black; border-color:#B0535E" class=" col-md-12 btn btn-primary">
                                                        {{ __('Iniciar sesión') }}
                                                    </button>
                    
                                                    @if (Route::has('password.request'))
                                                        <a class=" col-md-12 btn btn-link" style="color: #B0535E" href="{{ route('password.request') }}">
                                                            {{ __('Olvidé mi contraseña') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/register" style="color: #B0535E">¿No tienes una cuenta? Ingresa aquí</a></div>
                                    </div>
=======
                                                <button type="submit" style="background-color:white; color:black; border-color:#B0535E" class=" col-md-12 btn btn-primary">
                                                    {{ __('Iniciar sesión') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @if (Route::has('password.request'))
                                <a class=" col-md-12 btn btn-link" style="color: #B0535E" href="{{ route('password.request') }}">
                                    {{ __('Olvidé mi contraseña') }}
                                </a>
                                @endif
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="/register" style="color: #B0535E">¿No tienes una cuenta? Ingresa aquí</a></div>
>>>>>>> 74a2dcb14bf2e6a3875aa251e9908cf2d5b958d6
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