<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dulce Encanto</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="/img/logo.png" />
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="/assets/css/variables.css" rel="stylesheet">
    <!-- <link href="/assets/css/variables-blue.css" rel="stylesheet"> -->
    <!-- <link href="/assets/css/variables-green.css" rel="stylesheet"> -->
    <!-- <link href="/assets/css/variables-orange.css" rel="stylesheet"> -->
    <!-- <link href="/assets/css/variables-purple.css" rel="stylesheet"> -->
    <!-- <link href="/assets/css/variables-red.css" rel="stylesheet"> -->
    <!-- <link href="/assets/css/variables-pink.css" rel="stylesheet"> -->

    <!-- Template Main CSS File -->
    <link href="/assets/css/main.css" rel="stylesheet">

</head>

<body style="background-color:#FBF5F6">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container container-fluid d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="/../img/logo.png" width="50px" height="50px">
                <h6 style="color: black;">Dulce Encanto</h6>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" aria-current="page" href="/">Inicio</a>
                    <li><a class="nav-link scrollto" href="#about">¿Quiénes Somos?</a></li>
                    <li><a class="nav-link scrollto" href="#services">Productos</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contacto</a></li>

                    <li class="nav-item scrollto">
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/home') }}" class="btn boton my-2 my-sm-0">Ir a plataforma</a>
                        @else
                        <a href="{{ route('login') }}" class="btn boton my-2 my-sm-0">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item scrollto">
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn boton my-2 my-sm-0">Registrarse</a>
                        @endif
                        @endauth
                        @endif
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative aos-init aos-animate" data-aos="zoom-out">
            <img src="img/logo.png" class="img-fluid animated" width="300px" height="300px">
            <h2>
                <font face="Harlekin" style="color: black;"> Bienvenido(a) <span style="color: #B0535E;">Dulce Encanto</span></font>
            </h2>
            <p style="color: black;">Tortas temáticas, para todo tipo de ocasión <br> ¡Elaboramos tortas a tu gusto!</p>
        </div>
    </section>

    <main id="main">
        <!-- ======= Quienes somos ======= -->
        <section id="about" class="about">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="section-header">
                    <h2 style="color: #B0535E;"><b>¿Quiénes Somos?</b></h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                        quam nemo quod cumque harum ducimus provident modi magnam eos perspiciatis? Eligendi aspernatur
                        incidunt id enim non quae a mollitia consequuntur. vident modi magnam eos perspiciatis? Eligendi
                        aspernatur im non quae a mollitia consequuntur.
                    </p>
                </div>
                <div class="row g-4 g-lg-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="img/preprar.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="img/arinas.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Section -->

        <!-- ======= productos ======= -->
        <section id="services" class="services">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="section-header">
                    <h2 style="color: #B0535E;"><b>Nuestros Productos</b></h2>
                    <p style="color: black;">Ea vitae aspernatur deserunt voluptatem impedit deserunt magnam occaecati dssumenda quas ut ad dolores adipisci aliquam.</p>
                </div>

                <div class="row gy-5">
                    <div class="col-xl-4 col-md-6 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="imagenes/PastelChocolate.jpg" class="img-fluid" width="500px" height="400px">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Pastel de Chocolate</h3>
                                </a>
                                <p>Este irresistible pastel está hecho a base de chocolate y café, decorado con una deliciosa crema mascarpone.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                        <div class="service-item">
                            <div class="img">
                                <img src="imagenes/PastelChocolate.jpg" class="img-fluid" width="500px" height="400px">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Pastel de Chocolate</h3>
                                </a>
                                <p>Este irresistible pastel está hecho a base de chocolate y café, decorado con una deliciosa crema mascarpone.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="400">
                        <div class="service-item">
                            <div class="img">
                                <img src="imagenes/PastelChocolate.jpg" class="img-fluid" width="500px" height="400px">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Pastel de Chocolate</h3>
                                </a>
                                <p>Este irresistible pastel está hecho a base de chocolate y café, decorado con una deliciosa crema mascarpone.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Section -->

        <!-- ======= Contacto ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-header">
                    <h2 style="color: #B0535E;"><b>Contacto</b></h2>
                    Síguenos en <a href="https://www.instagram.com/dulce_encanto_20205/" class="titulo">Instagram</a>
                </div>
            </div>

            <div class="container">
                <div class="row gy-5 gx-lg-5">
                    <div class="col-lg-8">
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7930.966710796359!2d-75.54442!3d6.331366!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x17d044d434229684!2sBarrio%20Las%20Vegas%20De%20Bello!5e0!3m2!1ses-419!2sco!4v1652471377078!5m2!1ses-419!2sco" width="2000" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div><!-- End Google Maps -->
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="info">
                            <div>
                                <h4><i class="bi bi-geo-alt flex-shrink-0"></i> Ubicación:</h4>
                                <p>Av 67 #67 - 78 <br> Bello, Las Vegas</p>
                            </div>
                            <div>
                                <h4><i class="bi bi-envelope flex-shrink-0"></i> Email:</h4>
                                <p>DulceEncanto@gmail.com</p>
                            </div>
                            <div>
                                <h4><i class="bi bi-phone flex-shrink-0"></i> Celular:</h4>
                                <p>+57 312 7018618 / +57 310 6368657</p>
                            </div><!-- End Info Item -->
                        </div>
                    </div>
                </div>
        </section><!-- End Team Section -->
    </main><!-- End #main -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>