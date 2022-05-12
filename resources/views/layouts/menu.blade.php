
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

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body style="background-color:#FBF5F6 ">
  <!-- ======= Header ======= -->
<header id="header" class="header fixed-top sticked" data-scrollto-offset="0">
    <div class="container container-fluid d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <img src="/../img/logo.png" width="50px" height="50px">
            <font face="Harlekin" style="color: black;" class="text-capitalize">Dulce Encanto</font>
        </a>
        <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto" aria-current="page" href="/" style="color:black;">Inicio</a>
            <li><a class="nav-link scrollto" href="#about" style="color:black;">¿Quiénes Somos?</a></li>
            <li><a class="nav-link scrollto" href="/productos" style="color:black;">Productos</a></li>
            <li><a class="nav-link" href="/contacto" style="color:black;">Contacto</a></li>
            
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
                @endif
            </li>
        </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative aos-init aos-animate" data-aos="zoom-out">
        <img src="img/pastel.png" class="img-fluid animated">
        <h2><font face="Harlekin" class="text-capitalize"> Bienvenid@ <span>Dulce Encanto</span></font></h2>
        <p>Tortas temáticas, para todo tipo de ocasión <br> ¡Elaboramos tortas a tu gusto!</p>
    </div>
</section>

<!-- ======= Quienes somos ======= -->
<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-header">
            <h2>¿Quiénes Somos?</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                quam nemo quod cumque harum ducimus provident modi magnam eos perspiciatis? Eligendi aspernatur
                incidunt id enim non quae a mollitia consequuntur. vident modi magnam eos perspiciatis? Eligendi
                aspernatur im non quae a mollitia consequuntur. vident modi magnam eos perspi Lorem ipsum dolor
                sit amet consectetur adipisicing elit. Fugit quam nemo quod cumque harum ducimus provident modi magn
                incidunt id enim non quae a mollitia consequuntur.</p>
        </div>
        <div class="row g-4 g-lg-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-5">
            <div class="about-img">
                <img src="img/revolverpastel.jpg" class="img-fluid" alt="">
            </div>
            </div>

            <div class="col-lg-5">
            <div class="about-img">
                <img src="img/revolverpastel.jpg" class="img-fluid" alt="">
            </div>
            </div>
        </div>
    </div>
  </section><!-- End About Section -->
  
  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2>Nuestros Productos</h2>
        <p>Ea vitae aspernatur deserunt voluptatem impedit deserunt magnam occaecati dssumenda quas ut ad dolores adipisci aliquam.</p>
      </div>

      <div class="row gy-5">
        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="assets/img/services-1.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Nesciunt Mete</h3>
              </a>
              <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis.</p>
            </div>
          </div>
        </div><!-- End Service Item -->
      </div>
    </div>
  </section><!-- End Services Section -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>




    