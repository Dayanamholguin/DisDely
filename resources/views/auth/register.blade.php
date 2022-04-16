
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registrar - DisDely</title>
        <link href="/css/sb-admin-2.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #B0535E">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main >
                    <div class="container" >
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="background: #F8EAEF"><h3 class="text-center font-weight-light my-4">Crear Cuenta</h3></div>
                                    <div class="card-body" style="background: #F8EAEF">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <label for="nombre"><b>Nombre</b></label>
                                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" placeholder="Ingrese su nombre" />
                                                        
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
                                                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" required autocomplete="apellido" placeholder="Ingrese su apellido" />
                                                        
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
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Ingrese su correo electrónico" />
                                                        
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
                                                        <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" required autocomplete="celular" placeholder="Ingrese su teléfono o celular" />
                                                        
                                                            @error('celular')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <label for="celularAlternativo"><b>Celular alternativo</b></label>
                                                        <input id="celularAlternativo" type="text" class="form-control @error('celularAlternativo') is-invalid @enderror" name="celularAlternativo" required autocomplete="celularAlternativo" placeholder="Ingrese su teléfono alternativo" />
                                                       
                                                            @error('celularAlternativo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <label for="fechaNacimiento"><b>Fecha nacimiento</b></label>
                                                        <input id="fechaNacimiento" type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" required autocomplete="fechaNacimiento"/>
                                                       
                                                            @error('fechaNacimiento')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <label for="inputFirstName"><b>Género</b></label> <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Masculino">
                                                        <label class="form-check-label" for="inlineRadio1">Masculino</label>
                                                      </div>
                                                      <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Femenino">
                                                        <label class="form-check-label" for="inlineRadio2">Femenino</label>
                                                      </div>
                                                </div>
                                            </div>
                                            <br>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <label for="password"><b>Contraseña</b></label>
                                                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" type="password" placeholder="Ingrese su contraseña" />
                                                                                  
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><a class="btn btn-primary btn-block" href="/login" style="background-color: #BE8C71; border-color: #BE8C71">Crear Cuenta</a></div>
                                            </div>
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
            <br><br>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; DisDely 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/sb-admin-2.js"></script>
    </body>
</html>
