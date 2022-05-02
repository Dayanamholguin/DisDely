<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <title>Dulce Encanto</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="/css/wel.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Favicons -->
        <link href="/css/style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="/img/logo.png" />
        <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <meta name="theme-color" content="#7952b3">
    </head>
    <body class="fondo">
        <header>
            <nav class="navbar navbar-expand-md navbar-transparent fixed-top bg-light">
                <div class="container">
                    <a class="d-flex align-items-center justify-content-center flex-wrap">
                        <div class="sidebar-brand-icon">
                            <img src="/../img/logo.png" width="50px" height="50px">
                        </div>
                        <div class="sidebar-brand-text mx-3 p-3">
                            <font face="Harlekin" style="color: black;" class="text-capitalize">Dulce Encanto</font>
                        </div>
                    </a>
                    <div>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/" style="color:black;">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/quienes" style="color:black;">¿Quiénes Somos?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/productos" style="color:black;">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/contacto" style="color:black;">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    @if (Route::has('login'))
                                            @auth
                                                <a href="{{ url('/home') }}" class="btn boton my-2 my-sm-0">Ir a plataforma</a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn boton my-2 my-sm-0">Iniciar Sesión</a>

                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}" class="btn boton my-2 my-sm-0">Registrarse</a>
                                                @endif
                                            @endauth
                                        </div>
                                    @endif
                                    {{-- <a href="/login" class="btn boton my-2 my-sm-0">Iniciar Sesión</a>
                                    <a href="/register" class="btn boton my-2 my-sm-0">Registrarse</a> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="coloro">
                <section class="py-5 text-center container">
                    <div class="row py-lg-5">
                        <div class="col-lg-6 col-md-13 mx-auto">
                            <h1>
                                <font face="Harlekin" style="color: black;" class="text-capitalize">@yield('titulo')</font>
                            </h1>
                            <p class="lead text-muted">@yield('comentario')</p>
                        </div>
                    </div>
                </section>
            </div>
            @yield('content')
        </main>
        <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>