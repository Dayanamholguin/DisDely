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
        @if (strpos(url()->previous(), "/pedido/ver/"))
        <a href="{{url()->previous()}}" class="titulo alert-link">Volver</a>
        @else
        <a href="/pedido" class="titulo alert-link">Volver</a>
        @endif
    </div>
    <div class="card-body text-center">
        @include('flash::message')

        <div class="row">
            @foreach($cliente as $item)
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Nombre del responsable del pedido</strong></label>
                    <p class="form-control">{{$item->id==1?$item->nombre:$item->nombre ." ". $item->apellido}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mb-2">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Número del pedido</strong></label>
                    <p class="form-control">N° {{$pedido->id}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Precio total del pedido</strong></label>
                    <p class="form-control">$ {{number_format($precio, 0, '.', '.')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Ha abonado: </strong></label>
                    <p class="form-control">$ {{number_format($nAbonos, 0, '.', '.')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Falta por pagar: </strong></label>
                    <p class="form-control">$ {{
                            $nAbonos==$precio?"0.0":number_format($resta==0?$precio:$resta, 0, '.', '.');
                          
                        }}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Porcentaje del pago: </strong></label>
                    <p class="form-control">{{$porcentaje}} %</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for=""><strong>Estado del pedido en el abono: </strong></label>
                    @if($estado==3)
                    <p class="form-control bg-danger text-white">Pedido anulado</p>
                    @elseif ($paga)
                    <p class="form-control bg-success text-white">Pedido pago</p>
                    @else
                    <p class="form-control bg-warning text-white">Proceso de abono</p>
                    @endif
                </div>
            </div>
        </div>

        @if (count($abonos)==0)
            <p class="text-center">No se ha registrado ningún abono a este pedido</p>
            @can('abono/crear')
                @if ($estado!=3)
                    <p><a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link ">Registra el primer abono dando clic
                        aquí</a></p>
                @elseif($estado==3)
                    <em class="text-center">No se puede crear un abono a este pedido ya que está anulado</em>
                @endif
            @endcan
        @else
            <div class="d-flex justify-content-center">
                <strong>Información detallada de la realización del abono</strong>
                @if($nAbonos!=$precio)
                @can('abono/crear')
                @if ($estado!=3)
                /
                <a href="/abono/crear/{{$pedido->id}}" class="titulo alert-link">Registrar abono de este pedido</a>
                @endif
                @endcan
                @endif
            </div>
            <table class="table mt-4">
                <thead>
                    <tr id="infoAbonos" style="cursor: pointer;">
                        <th scope="col">#</th>
                        <th scope="col">Abono</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Comprobante</th>
                    </tr>
                </thead>
                <tbody id="panel">
                    @foreach ($abonos as $item)
                        <tr @if ($item->estado==1) @can('abono/cambiarEstado') data-toggle="collapse"
                            data-target="#id-{{$item->id}}" class="accordion-toggle" onclick="mostrar({{$item->id}})"
                            style="cursor: pointer;" @endcan @endif>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{number_format($item->precioPagar, 0, '.', '.')}}</td>
                            <td>{{ucwords(Date::create($item->created_at)->format('l, j F Y'))}}</td>
                            <td>
                                @if ($item->img==null)
                                No hay comprobante
                                @else
                                <div class="portfolio-img"><a href="/ver/imagenAbono/{{$item->img}}"
                                        data-gall="portfolioGallery" class="venobox preview-link titulo alert-link"
                                        title="Comprobante del abono {{$item->id}}">Sí hay comprobante</a></div>
                                @endif
                            </td>
                        </tr>
                        @can('abono/cambiarEstado')
                            <tr>
                                <td colspan="6" class="hiddenRow">
                                    {{-- <div id="demo3" class="accordian-body collapse"> --}}
                                    <div id="id-{{$item->id}}" class="accordian-body collapse">
                                        <div class="col-md-12 col-sm-12 mt-3" id="abono">
                                            {{-- --}}
                                            <div class="mostrar">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form id="form2-{{$item->id}}" action="/abono/AD/guardar" method="POST"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            {{-- <input type="hidden" name="idUser" value="{{$userId}}" /> --}}
                                                            <input type="hidden" id="idAbono-{{$item->id}}" value="" name="id">
                                                            <div class="row mb-2">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for=""><b>Razón</b> <b style="color: red"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Requerido"> *</b></label>
                                                                        <select name="estado"
                                                                            class="form-control @error('estado') is-invalid @enderror">
                                                                            <option value="">Seleccione</option>
                                                                            <option value="2"
                                                                                {{old('estado' ) == 1 ? 'selected' : ''}}>Anulado
                                                                            </option>
                                                                            <option value="3"
                                                                                {{old('estado' ) == 2 ? 'selected' : ''}}>Devuelto
                                                                            </option>
                                                                        </select>
                                                                        @error('estado')
                                                                        <div class="alert alert-danger" role="alert">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-2 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for=""><b>N° Abono</b> <b style="color: red"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Requerido"> *</b></label>
                                                                        <input type="text" class="form-control form-control-sm "
                                                                            id="nAbono-{{$item->id}}" value="" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for=""><b>Precio</b> <b style="color: red"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Requerido"> *</b></label>
                                                                        <input type="text" class="form-control form-control-sm "
                                                                            id="precio-{{$item->id}}" value="" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-8 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for=""><b>Justificación</b> <b style="color: red"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Requerido"> *</b></label>
                                                                        <input type="text" class="form-control form-control-sm"
                                                                            value="" name="justificacion" id="justificacion">
                                                                        @error('justificacion')
                                                                        <div class="alert alert-danger" role="alert">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="centrado">
                                                                <button class="btn btn-dark mb-3">Aceptar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                </tbody>
            </table>
            @if (count($abonosAnulado)!=0 && count($abonosDevuelto)!=0)
                <div class="row mb-2 mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="d-flex justify-content-center">
                            <strong>Información de abonos anulados</strong>
                        </div>
                        <table class="table mt-4">
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
                        <div class="d-flex justify-content-center align-items-center" style="size: 100%">
                            {{ $abonosAnulado->links() }}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="d-flex justify-content-center">
                            <strong>Información de abonos devueltos</strong>
                        </div>
                        <table class="table mt-4" style="overflow:scroll;">
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
                        <div class="d-flex justify-content-center align-items-center" style="size: 100%">
                            {{ $abonosDevuelto->links() }}
                        </div>
                    </div>
                </div>
            @elseif(count($abonosAnulado)!=0 && count($abonosDevuelto)==0)
                <div class="row mb-2 mt-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="d-flex justify-content-center">
                            <strong>Información de abonos anulados</strong>
                        </div>
                        <table class="table mt-4">
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
                        <div class="d-flex justify-content-center align-items-center" style="size: 100%">
                            {{ $abonosAnulado->links() }}
                        </div>

                    </div>
                </div>
            @elseif(count($abonosAnulado)==0 && count($abonosDevuelto)!=0)
                <div class="row mb-2 mt-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="d-flex justify-content-center">
                            <strong>Información de abonos devueltos</strong>
                        </div>
                        <table class="table mt-4">
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
                        <div class="d-flex justify-content-center align-items-center" style="size: 100%">
                            {{ $abonosDevuelto->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
{{-- Modal --}}
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
                                    <p id="justificacionM"> </p>
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
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $("#infoAbonos").click(function() {
        $("#panel").fadeToggle();
    });
});

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
        day: 'numeric',
        hours: 'numeric'
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
            $('#justificacionM').html(res.abono.justificacion);
        },
    });
}

function mostrar(abono) {
    $.ajax({
        url: `/abono/AD/${abono}`,
        type: "GET",
        success: function(res) {
            // $('#nombre').html(res.name);
            $('#idAbono-' + res.id).val(res.id);
            $('#nAbono-' + res.id).val(res.id);
            $('#precio-' + res.id).val(number_format(res.precioPagar, 0, '.', '.'));
        },
    });
    $('#form2-' + abono).validate({
        rules: {
            justificacion: {
                required: true,
                minlength: 5,
                maxlength: 500
            },
            estado: {
                required: true
            }
        }
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