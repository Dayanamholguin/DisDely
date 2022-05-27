@extends('layouts.app')
@section('car')
@include('carrito.icono')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">

        
        <div class="card">
            <div class="card-header text-center">
                <strong>Edición de la cotizacion</strong> / <a href="/cotizacion" class="alert-link titulo">Volver</a>
            </div>
            <div class="card-body">
                <div class="container mt-1">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            @include('flash::message')
                        </div>
                    </div>
                </div>
                <form id="form" action="/cotizacion/guardar" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idUser" value="{{$cotizacion->idUser}}" />
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Cliente que hizo la cotización<b style="color: red"> *</b></label>
                                <input type="text" readonly value="{{$cotizacionUsuario}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Fecha de entrega<b style="color: red"> *</b></label>
                                <input id="fechaEntrega" type="date" value="{{$cotizacion->fechaEntrega, date('Y-m-d')}}" class="form-control @error('fechaEntrega') is-invalid @enderror" name="fechaEntrega" required autocomplete="fechaEntrega" />
                                @error('fechaEntrega')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Descripción<b style="color: red"> *</b></label>
                                <textarea type="text" value="{{ $cotizacion->descripcionGeneral }}" class="form-control @error('descripcionGeneral') is-invalid @enderror" id="descripcionGeneral" name="descripcionGeneral" placeholder="Ingrese la descripción" required>{{ $cotizacion->descripcionGeneral }}{{ old('descripcionGeneral') }}</textarea>
                                @error('descripcionGeneral')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUxJREFUSEvNlN0xBEEUhb8TAZsBEbARKBGQAV55YCMgAzzwakWADGRgRUAGNoOjempazU/PTFfNrtr7ONN9v3vOvbfFmkNrzs//AWy7VLME5pJmq1D3p6ACiHkPJb2PhbQssn0F3AJvko5TgFiMpEGLU4Bt4KdMvCvpuwkZBQjJbM+BE+BeUlBUi1UA9oEPYClpUkLjECTb0mVXp4e2F8AecCZpnhiCGigAUsr7AKfAE7CQNK1m67LIdhjxLWAqKRTYv2ipC1W7qrbYjgV9SgoWF9E7ZrbvgEvgWVJIUERKge2wMwfR0lzADvBVHp5ICha0wnbnucFFsf0KHAEzSUFRCnADXDeVDlpU2hG2+SU5m+2PredlUEEJiSPbx6k1N6sHmVX3HstV8ACcA4+SLho70fkvqwfVsSwuNF7Q6oannovNUDCmF1kKNhrwC7rGoRm2ijZeAAAAAElFTkSuQmCC" /> Añadir producto a cotización</button>
                        </div>
                    </div>
                
            </div>
        </div>
        
    </div>
    <br><br>
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

<script>
    function mostrar(producto) {
        $("#imagen").show();
        $.ajax({
                url: `/ver/carrito/${producto}`,
                type: "GET",
                success: function (res) {
                    $('#nombre').html(res.name);
                    $('#sabor').html(res.attributes.saborDeseado);
                    $('#nPersonas').html(res.attributes.numeroPersonas);
                    $('#pisos').html(res.attributes.pisos);
                    if (res.attributes.frase==null) {
                        $('#frase').html("No tiene frase");
                    }else {
                        $('#frase').html(res.attributes.frase);
                    }
                    $('#descripcionProducto').html(res.attributes.descripcionProducto);
                    if (res.attributes.imagen1==null) {
                        $('#imagen1').attr("src","");
                        $('#foto').html("No tiene imágenes");
                    }else {
                        $('#foto').html("");
                        let imagen= "/imagenes/"+res.attributes.imagen1;
                        $('#imagen1').attr("src",imagen);
                    }
                },
            });
    }
</script>

@endsection