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
@if (count($abonos)==0 && count($abonosAnulado)==0 && count($abonosDevuelto)==0)
<p class="text-center p-3">No se ha registrado ningún abono a este pedido</p>
@can('abono/crear')
<p class="text-center"><a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link">Registra el primer abono dando
        clic aquí</a></p>
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
        @if (count($abonos)==0)
        <p class="text-center">No se ha registrado ningún abono a este pedido</p>
        @else
        <table class="table mt-4" style="width: auto;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Abono</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abonos as $item)
                <tr>
                    <th scope="row">{{$item->id}}

                        @if($item->estado==2)
                        <em class="text-danger " style="font-size: 12px;">(Anulado)</em>
                        @elseif($item->estado==3)
                        <em class="text-primary " style="font-size: 12px;">(Devuelto)</em>
                        @endif

                    </th>
                    <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                    <td>{{ucwords(Date::create($item->created_at)->format('l, j F Y'))}}</td>
                    <td>
                        @if ($item->img==null)
                        No hay imagen
                        @else
                        <div class="portfolio-img"><a href="/ver/imagenAbono/{{$item->img}}"
                                data-gall="portfolioGallery" class="venobox preview-link titulo alert-link"
                                title="Comprobante del abono {{$item->id}}">Sí hay imagen</a></div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @if (count($abonosAnulado)!=0 && count($abonosDevuelto)!=0)
        <div class="row mb-2 mt-4">
            <div class="col-md-6 col-sm-12">
                <div class="d-flex justify-content-center">
                    <strong>Información de abonos anulados</strong>
                </div>
                <table class="table mt-4" style="width: auto;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Abono</th>
                            <th scope="col">Razón</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonosAnulado as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                            <td>
                                <em style="font-size: 12px;">
                                    <a href="javascript:void(0)"
                                        class="{{$item->estado==2?"text-danger":"text-primary"}}"
                                        onclick="mostrarVentana({{$item->id}})" data-toggle="tooltip"
                                        data-placement="top" title="Clic para ver información">
                                        {{$item->estado==2?"(Anulado)":"(Devuelto)"}}
                                    </a>
                                </em>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="d-flex justify-content-center">
                    <strong>Información de abonos devueltos</strong>
                </div>
                <table class="table mt-4" style="overflow:scroll;" style="width: auto;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Abono</th>
                            <th scope="col">Razón</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonosDevuelto as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                            <td>
                                <em style="font-size: 12px;">
                                    <a href="javascript:void(0)"
                                        class="{{$item->estado==2?"text-danger":"text-primary"}}"
                                        onclick="mostrarVentana({{$item->id}})" data-toggle="tooltip"
                                        data-placement="top" title="Clic para ver información">
                                        {{$item->estado==2?"(Anulado)":"(Devuelto)"}}
                                    </a>
                                </em>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @elseif(count($abonosAnulado)!=0 && count($abonosDevuelto)==0)
        <div class="row mb-2 mt-4">
            <div class="col-md-12 col-sm-12">
                <div class="d-flex justify-content-center">
                    <strong>Información de abonos anulados</strong>
                </div>
                <table class="table mt-4" style="width: auto;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Abono</th>
                            <th scope="col">Razón</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonosAnulado as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                            <td>
                                <em style="font-size: 12px;">
                                    <a href="javascript:void(0)"
                                        class="{{$item->estado==2?"text-danger":"text-primary"}}"
                                        onclick="mostrarVentana({{$item->id}})" data-toggle="tooltip"
                                        data-placement="top" title="Clic para ver información">
                                        {{$item->estado==2?"(Anulado)":"(Devuelto)"}}
                                    </a>
                                </em>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @elseif(count($abonosAnulado)==0 && count($abonosDevuelto)!=0)
        <div class="row mb-2 mt-4">
            <div class="col-md-12 col-sm-12">
                <div class="d-flex justify-content-center">
                    <strong>Información de abonos devueltos</strong>
                </div>
                <table class="table mt-4" style="width: auto;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Abono</th>
                            <th scope="col">Razón</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonosDevuelto as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                            <td>
                                <em style="font-size: 12px;">
                                    <a href="javascript:void(0)"
                                        class="{{$item->estado==2?"text-danger":"text-primary"}}"
                                        onclick="mostrarVentana({{$item->id}})" data-toggle="tooltip"
                                        data-placement="top" title="Clic para ver información">
                                        {{$item->estado==2?"(Anulado)":"(Devuelto)"}}
                                    </a>
                                </em>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
{{-- modal --}}
<div class="modal fade" id="verAbono" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div>
                            <strong>Ver información del abono</strong>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for=""><strong>Número del abono</strong></label>
                                    <p class="form-control" id="id"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for=""><strong>Precio del abono</strong></label>
                                    <p class="form-control" id="precioAbono"> </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for=""><strong>Razón</strong></label>
                                    <p class="form-control" id="estado"> </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for=""><strong>Fecha de eliminación</strong></label>
                                    <p class="form-control" id="fecha"> </p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for=""><strong>Justificación</strong></label>
                                    <p id="justificacion"> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
<script>
function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
        return $1.toUpperCase();
    });
}

function mostrarVentana(id) {
    var options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    $('#verAbono').modal('toggle');
    $.ajax({
        url: `/abono/verAbonoAjax/${id}`,
        type: "GET",
        success: function(res) {
            $('#id').html(res.abono.id);
            $('#precioAbono').html((number_format(res.abono.precioPagar, 0, '.', '.')));
            $('#estado').html(res.nombre);
            $('#fecha').html(ucwords(new Date(res.abono.updated_at).toLocaleDateString("es-ES", options)));
            $('#justificacion').html(res.abono.justificacion);
        },
    });
}
</script>
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