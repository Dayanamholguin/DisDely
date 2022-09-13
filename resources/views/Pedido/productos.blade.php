@extends('layouts.app')
@section('css')
<!-- <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
<link href="/assetsGallery/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assetsGallery/vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="/assetsGallery/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/assetsGallery/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/assetsGallery/vendor/venobox/venobox.css" rel="stylesheet">
<link href="/assetsGallery/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/assetsGallery/vendor/aos/aos.css" rel="stylesheet">
<link href="/assetsGallery/css/style.css" rel="stylesheet">
@endsection
@section('title')
Productos para los pedidos
@endsection
@section('car')
<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" id="buscarMovil"
                    placeholder="Buscar pastel..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>
@endsection
@section('content')
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Productos</h2>
            <p>Selecciona el producto con el que vas a realizar el pedido</p>
        </div>
        @include('flash::message')
        @if(count($productos) == 0)
        <p class="d-flex justify-content-center">No hay productos registrados</p>
        @else

        <!--Search-->
        <style>
        .hol {
            display: flex;
            align-items: center;
        }

        form>div {
            display: flex;
            background: #fff;
            padding: 9px 22px 9px 26px;
            border-radius: 30px;
            border: 2px solid #B0535E;
            box-shadow: rgba(255, 255, 255, 0.5) -8px -8px 15px,
                rgba(0, 0, 0, 0.1) 10px 10px 10px,
                rgba(255, 255, 255, 0.5) -8px -8px 15px inset,
                rgba(0, 0, 0, 0.1) 10px 10px 10px inset;
        }

        form input {
            border: none;
            background: transparent;
            font-weight: bold;
            padding-left: 24px;
            background-size: 16px;
            width: 0px;
            transition: all 1s;
        }

        form input:focus {
            outline: none;
            width: 250px;
        }
        </style>

        <form class="hol">
            <div>
                <i class="bi bi-search"></i>
                <input type="text" name="" id="buscar" placeholder="Buscar..." autocomplete="off">
            </div>
        </form>

        <br>

        <div class="row product-list" id="product-list" data-aos="fade-up" data-aos-delay="200">
            <div class="contenedor-galeria">
                @foreach($productos as $producto)
                <div class="col-md-12 galeria__img item portfolio-item filter-app product">
                    <div class="portfolio-img"><a href="/ver/imagen/{{$producto->id}}" data-gall="portfolioGallery"
                            class="venobox preview-link" title="{{$producto->nombre}}"><img
                                style="background-size: 100% 100%; width: 100%" src="/imagenes/{{$producto->img}}"
                                class="img-fluid" alt=""></a></div>
                    <div class="portfolio-info">
                        <h4 class="nombres">{{$producto->nombre}}</h4>

                        <p>{{ucfirst(Date::create($producto->created_at)->format('F j, Y'));}}</p>
                        <a href="/pedido/crear/{{$producto->id}}/{{$cliente->id}}" class=" details-link"
                            data-toggle="tooltip" data-placement="top" title="Clic para realizar el pedido"><img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAFxJREFUSEtjZKAxYKSx+QyjFhAMYZKC6P////9BJjIyMhKtj2iFIINHLSAYYUMniGAuJeglNAXYUhfWVERzC3C5fOjEwagPkENgcJVFpOYLcMlLjiZS9IxaQDC0AFaEOBlExtG1AAAAAElFTkSuQmCC" /></a>
                        {{-- <a href="/producto/verProductoCatalogo/{{$producto->id}}" class="details-link" ><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAVVJREFUSEvVVVFRA0EUSxSABFBA6wAcgAJwADgAB8UBOMABoIA6oBKogjBh3nYe7e4thSsz7Mx9XPc2yea9lxI7XtwxPpoEkg4AXAI4BjAJIXMAzwDuSC6+I65KIGkW4EMYM5LXPZINAklWeRQHHwAYyL9Bkm9yBeC83IjkdIjkC0FSvrQ1BXgdIIhs1V7YZdLqWhGE52/x1bQFXlCC5DXeD1s1yQTFdxewqSjLlHQfdjXPZILifVd95RbzVi0ygXyQ5FazIWnw3FgES5L7tSqPZdELSQ/kxvrTIjsaftKmnplJt01jUkurvgM46QzaEwD7fkvypjtoqfVyVLjP3eM5KhyAFwnQexZjUe0arA1QL+xsi785jdxqkvTi2hPt7nD4GdRAfhyAC0m2yJnk/SrJVkNVs6BH8muCaI58kzOSj0XMKASJxBG/Av+MnqE/izH2/j/BB3p8rBlg04KKAAAAAElFTkSuQmCC" /></a>
                        --}}
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section><!-- End Portfolio Section -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#buscar').keyup(function() {
        var nombres = $('.nombres');
        var buscando = $(this).val();
        var item = '';
        for (var i = 0; i < nombres.length; i++) {
            item = $(nombres[i]).html().toLowerCase();
            for (var x = 0; x < item.length; x++) {
                if (buscando.length == 0 || item.indexOf(buscando) > -1) {
                    $(nombres[i]).parents('.item').show();
                } else {
                    $(nombres[i]).parents('.item').hide();
                }
            }
        }
    });
});
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="/assetsGallery/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assetsGallery/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/assetsGallery/vendor/php-email-form/validate.js"></script>
<script src="/assetsGallery/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="/assetsGallery/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assetsGallery/vendor/venobox/venobox.min.js"></script>
<script src="/assetsGallery/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/assetsGallery/vendor/aos/aos.js"></script>
<!-- Template Main JS File -->
<script src="/assetsGallery/js/main.js"></script>
@endsection