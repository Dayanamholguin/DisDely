<!doctype html>
<html lang="en">

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
    <link rel="icon" type="image/x-icon" href="/img/logo.png" />
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-transparent fixed-top bg-transparent">
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
                                <a class="nav-link active" aria-current="page" href="#" style="color:black;">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:black;">¿Quiénes Somos?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:black;">Categorías</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:black;">Galería</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:black;">Contacto</a>
                            </li>
                            <li class="nav-item">
                                <a href="/login" class="btn boton my-2">Iniciar Sesión</a>
                                <a href="/register" class="btn boton my-2">Registrarse</a>
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
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h3 class="fw-light">Dulce Encanto</h3>
                        <p class="lead text-muted">Tortas temáticas, para todo tipo de ocasión <br> ¡Elaboramos tortas a tu gusto!</p>                      
                    </div>
                </div>
            </section>
        </div>
        <h2>Nuestros Productos</h2>
        <div class="content-all">
            <div class="content-carrousel">
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
                <figure><img src="/img/pastel.png"></figure>
            </div>
        </div>

        <!-- <div class="container">
            <hr class="featurette-divider">
            <h4 class="text-center">Nuestros Productos</h4>
            <div class="album py-1  d-flex justify-content-center">
                <div id="myCarousel" class="carousel slide w-75 h-50" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/img/cook.jpg" class="d-block w-100" alt="..." width="8000" height="400">
                            <div class="container">
                                <div class="carousel-caption text-center">
                                    <h1>Torta de Chocolate.</h1>
                                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                                    <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/img/pastel.jpg" class="d-block w-100" alt="..." width="8000" height="400">
                            <div class="container">
                                <div class="carousel-caption text-center">
                                    <h1>Torta de Fresa.</h1>
                                    <p>Some representative placeholder content for the second slide of the carousel.</p>
                                    <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/img/pasteles.jpg" class="d-block w-100" alt="..." width="8000" height="400">
                            <div class="container">
                                <div class="carousel-caption  text-center">
                                    <h1>Torta de Arequipe.</h1>
                                    <p>Some representative placeholder content for the third slide of this carousel.</p>
                                    <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div> -->
        <!-- <div class="row">
                <div class="col-md-12">
                    <h2>Featured <b>Products</b></h2>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">


                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                    </ol>   


                    <div class="carousel-inner">
                        <div class="item carousel-item active">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/cook.jpg" class="img-fluid" alt="">									
                                        </div>
                                        <div class="thumb-content">
                                            <h1>Torta de Arequipe.</h1> 
                                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                                            <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/cook.jpg" class="img-fluid" alt="">									
                                        </div>
                                        <div class="thumb-content">
                                            <h1>Torta de Arequipe.</h1> 
                                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                                            <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/cook.jpg" class="img-fluid" alt="">									
                                        </div>
                                        <div class="thumb-content">
                                            <h1>Torta de Arequipe.</h1> 
                                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                                            <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/cook.jpg" class="img-fluid" alt="">									
                                        </div>
                                        <div class="thumb-content">
                                            <h1>Torta de Arequipe.</h1> 
                                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                                            <p><a class="btn btn-lg btn-success" href="/login">Realiza tu Cotización</a></p>
                                        </div>						
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item carousel-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pasteles.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pasteles.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>	
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pasteles.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pasteles.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>						
                            </div>
                        </div>
                        <div class="item carousel-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pastel.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>	
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pastel.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>	
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pastel.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>	
                                <div class="col-sm-3">
                                    <div class="thumb-wrapper">
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="img-box">
                                            <img src="/img/pastel.jpg" class="img-fluid" alt="Play Station">
                                        </div>
                                        <div class="thumb-content">
                                            
                                        </div>						
                                    </div>
                                </div>					
                            </div>
                        </div>
                    </div>


                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
                </div>
            </div> -->
        </div>

    </main>
    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>