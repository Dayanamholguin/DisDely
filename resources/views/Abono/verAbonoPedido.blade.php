@extends('layouts.app')

@section('title')
Abonos
@endsection
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

@section('content')
@if (count($abonos)==0)
    <p class="text-center p-3">No se ha registrado ningún abono a este pedido</p>
    @can('abono/crear')
        <p class="text-center"><a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link">Registra el primer abono dando clic aquí</a></p>
    @endcan 
    @can('/abono')
        <p class="text-center"><a href="/abono" class="titulo alert-link">Volver</a></p>
    @endcan 
@else
<div class="card">
    <div class="card-header text-center">
        
        <strong>Visualización de los abonos del pedido N° {{$pedido->id}}</strong> /
        <a href="/abono" class="titulo alert-link">Volver</a>
        
    </div>
    <div class="card-body text-center">
        @include('flash::message')
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Abono</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Comprobante</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($abonos as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                        <td>{{ucwords(Date::create($item->created_at)->format('l, j F Y'))}}</td>
                        <td>
                            @if ($item->img==null)
                                No hay comprobante
                            @else
                            <div class="portfolio-img"><a href="/ver/imagenAbono/{{$item->img}}" data-gall="portfolioGallery" class="venobox preview-link titulo alert-link" title="Comprobante del abono {{$item->id}}">Sí hay comprobante</a></div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</div>
@endif
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
@endsection
