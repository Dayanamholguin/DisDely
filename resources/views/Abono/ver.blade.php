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
<div class="card">
    <div class="card-header text-center">
        <strong>Visualización de los abonos del pedido N° {{$pedido->id}}</strong> /
        <a href="/pedido" class="titulo alert-link">Volver</a>
    </div>
    <div class="card-body text-center">
        @include('flash::message')
        @if (count($abonos)==0)
            <p class="text-center p-3">No se ha registrado ningún abono a este pedido</p>
            @can('abono/crear')
                <p><a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link ">Registra el primer abono dando clic aquí</a></p>
            @endcan   
        @else
            <div class="row">
                @foreach($cliente as $item)
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Nombre del responsable del pedido</strong></label>
                        <p  class="form-control">{{$item->id==1?$item->nombre:$item->nombre ." ". $item->apellido}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Número del pedido</strong></label>
                        <p  class="form-control">N° {{$pedido->id}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Precio total del pedido</strong></label>
                        <p  class="form-control">$ {{number_format($precio, 0, '.', '.')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Ha abonado: </strong></label>
                        <p  class="form-control">$ {{number_format($nAbonos, 0, '.', '.')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Falta por pagar: </strong></label>
                        <p  class="form-control">$ {{number_format($resta, 0, '.', '.')}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Porcentaje del pago: </strong></label>
                        <p  class="form-control">{{$porcentaje}} %</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for=""><strong>Estado del pedido en el abono: </strong></label>
                        @if ($paga)
                        <p class="form-control bg-success text-white" >Pedido pago</p>
                        @else
                        <p class="form-control bg-warning text-white" >Proceso de abono</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <strong>Información detallada de la realización del abono</strong> 
                @can('abono/crear')
                / 
                <a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link">Registrar abono de este pedido</a>
                @endcan
            </div>
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
        @endif
    </div>
</div>
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
