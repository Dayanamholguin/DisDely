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
@section('car')
@include('carrito.icono')
@endsection
@section('content')
<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Catálogo de productos</h2>
            <p>Acá podrás encontrar los productos registrados en la plataforma, podrás visualizarlos, ver el detalle y
                si así lo quieres ¡Cotizar!</p>
        </div>
        <div class="container mt-2 mb-2">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        @if(count($productos) == 0)
        <p class="d-flex justify-content-center">No hay productos registrados</p>
        @else
        <ul id="portfolio-flters" class="d-flex justify-content-center boton" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">Todo</li>
        </ul>

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
                border: 2px solid #cad3dc;
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
                <input type="text" name="" id="searh-item" placeholder="Buscar..." onkeyup="search()">
            </div>
        </form>


        
        <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input id="formulario" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="boton" class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <ul id="resultado">

            </ul>
        </form> -->
        <br>

        <div class="row portfolio-container product-list" id="product-list" data-aos="fade-up" data-aos-delay="200">
            @foreach($productos as $producto)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app product">
                <div class="portfolio-img"><a href="/ver/imagen/{{$producto->id}}" data-gall="portfolioGallery" class="venobox preview-link" title="{{$producto->nombre}}"><img style="background-size: 100% 100%;" src="/imagenes/{{$producto->img}}" class="img-fluid" alt=""></a></div>
                <div class="portfolio-info">
                    <h4>{{$producto->nombre}}</h4>

                    <p>{{$producto->created_at->toFormattedDateString()}}</p>
                    <a href="/cotizacion/crear/{{$producto->id}}" class=" preview-link"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAFxJREFUSEtjZKAxYKSx+QyjFhAMYZKC6P////9BJjIyMhKtj2iFIINHLSAYYUMniGAuJeglNAXYUhfWVERzC3C5fOjEwagPkENgcJVFpOYLcMlLjiZS9IxaQDC0AFaEOBlExtG1AAAAAElFTkSuQmCC" /></a>
                    <a href="/producto/verProductoCatalogo/{{$producto->id}}" class="details-link"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAVVJREFUSEvVVVFRA0EUSxSABFBA6wAcgAJwADgAB8UBOMABoIA6oBKogjBh3nYe7e4thSsz7Mx9XPc2yea9lxI7XtwxPpoEkg4AXAI4BjAJIXMAzwDuSC6+I65KIGkW4EMYM5LXPZINAklWeRQHHwAYyL9Bkm9yBeC83IjkdIjkC0FSvrQ1BXgdIIhs1V7YZdLqWhGE52/x1bQFXlCC5DXeD1s1yQTFdxewqSjLlHQfdjXPZILifVd95RbzVi0ygXyQ5FazIWnw3FgES5L7tSqPZdELSQ/kxvrTIjsaftKmnplJt01jUkurvgM46QzaEwD7fkvypjtoqfVyVLjP3eM5KhyAFwnQexZjUe0arA1QL+xsi785jdxqkvTi2hPt7nD4GdRAfhyAC0m2yJnk/SrJVkNVs6BH8muCaI58kzOSj0XMKASJxBG/Av+MnqE/izH2/j/BB3p8rBlg04KKAAAAAElFTkSuQmCC" /></a>
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
                </div>-->
        </div>
        @endif
    </div>
</section><!-- End Portfolio Section -->
@endsection

@section('scripts')



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

<script>
    //Search
    const search = () => {
        const searchbox = document.getElementById("searh-item").value.toUpperCase();
        const storeitems = document.getElementById("product-list");
        const product = document.querySelectorAll(".product");
        const pname = document.getElementsByTagName("h4");

        for (var i = 0; i < pname.length; i++) {
            let match = product[i].getElementsByTagName('h4')[0];

            if (match) {
                let textvalue = match.textContent || match.innerHTML

                if (textvalue.toUpperCase().indexOf(searchbox) > -1) {
                    product[i].style.display = "";
                } else {
                    product[i].style.display = "none";
                }
            }
        }
    }

    // $.ajax({
    //     url: `/producto/catalogo/${idCategoria}`,
    //     type: "GET",
    //     success: function (res){
    //         let productos = JSON.parse(res)
    //         productos.forEach(p => {
    //             document.querySelector(".contenedor").appendChild(`<p>nombre: ${p.nombre}</p>`
    //             )
    //         })
    //     },
    // });
</script>

<!-- <script>
    const productos = [{
            nombre: 'Platanos'
        },
        {
            nombre: 'Pera'
        },
        {
            nombre: 'Fresa'
        },
        {
            nombre: 'Sandia'
        },
        {
            nombre: 'Frutillas'
        },
    ]

    const formulario = document.querySelector('#formulario');
    const boton = document.querySelector('#boton');
    const resultado = document.querySelector('#resultado');

    const filtrar = () => {
        resultado.innerHTML = '';

        const texto = formulario.value.toLowerCase();

        for (let producto of productos) {
            let nombre = producto.nombre.toLowerCase();
            if (nombre.indexOf(texto) !== -1) {
                resultado.innerHTML += `
        <li>${producto.nombre}</li>
        `
            }
        }
        if (resultado.innerHTML === '') {
            resultado.innerHTML += `
            <li>Producto no encontrado...</li>
        `
        }
    }

    boton.addEventListener('click', filtrar)
    formulario.addEventListener('keyup', filtrar)
    filtrar();
</script> -->

@endsection