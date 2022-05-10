@extends('layouts.app')

@section('css')
<!-- <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
<link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/assets/vendor/venobox/venobox.css" rel="stylesheet">
<link href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
@endsection

@section('content')
<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Catálogo de productos</h2>
            <p>Acá podrás encontrar los productos registrados en la plataforma, podrás visualizarlos, ver el detalle y si así lo quieres ¡Cotizar!</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        @foreach($productos as $producto)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img style="background-size: 100% 100%;" src="/imagenes/{{$producto->img}}"  class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>{{$producto->nombre}}</h4>
                    <p>{{$producto->descripcion}}</p>
                    <a href="/assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>
        @endforeach 
            <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Web 3</h4>
                    <p>Web</p>
                    <a href="/assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>App 2</h4>
                    <p>App</p>
                    <a href="/assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Card 2</h4>
                    <p>Card</p>
                    <a href="/assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Web 2</h4>
                    <p>Web</p>
                    <a href="/assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>App 3</h4>
                    <p>App</p>
                    <a href="/assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Card 1</h4>
                    <p>Card</p>
                    <a href="/assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Card 3</h4>
                    <p>Card</p>
                    <a href="/assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="/assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                    <h4>Web 3</h4>
                    <p>Web</p>
                    <a href="/assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div> -->
            

        </div>

    </div>
</section><!-- End Portfolio Section -->
@endsection

@section('scripts')
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/venobox/venobox.min.js"></script>
<script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="/assets/js/main.js"></script>
@endsection