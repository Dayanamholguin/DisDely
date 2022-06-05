@extends('layouts.app')
{{-- @section('car')
@include('carrito.icono')
@endsection --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(\Cart::getTotalQuantity()>0)
        <div class="card">
            <div class="card-header text-center">
                <strong>Edición del pedido</strong> / <a href="/pedido" class="alert-link titulo">Volver</a>
            </div>
            <div class="card-body">
                @include('flash::message')
                <form id="form" action="/pedido/actualizar" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idUser" value="{{$pedido->idUser}}" />
                    <input type="hidden" name="idPedido" value="{{$pedido->id}}" />
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Cliente que hizo la cotización<b style="color: red"> *</b></label>
                                <input type="text" readonly value="{{$pedidoUsuario}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Fecha de entrega<b style="color: red"> *</b></label>
                                <input id="fechaEntrega" type="date" value="{{$pedido->fechaEntrega, date('Y-m-d')}}" class="form-control @error('fechaEntrega') is-invalid @enderror" name="fechaEntrega" required autocomplete="fechaEntrega" />
                                @error('fechaEntrega')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Estado del pedido: <b style="color: red"> *</b></label>
                                <select class="form-control" name="estado">
                                    <option value="">Seleccione</option>
                                    @foreach($estadosPedido as $key => $value)
                                    <option {{$value->id == $pedido->estado ? 'selected' : ''}} {{old('estado' ) == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre}}</option>
                                    @endforeach
                                    @error('estado')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="">Descripción<b style="color: red"> *</b></label>
                                <textarea type="text" value="{{ $pedido->descripcionGeneral }}" class="form-control @error('descripcionGeneral') is-invalid @enderror" id="descripcionGeneral" name="descripcionGeneral" placeholder="Ingrese la descripción" required>{{ $pedido->descripcionGeneral }}{{ old('descripcionGeneral') }}</textarea>
                                @error('descripcionGeneral')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Precio<b style="color: red"> *</b></label>
                                <input type="text" value="{{$pedido->precio}}" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" placeholder="Ingrese el precio de la cotización para ser pasada a pedido"/>
                                @error('precio')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary mr-3"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUxJREFUSEvNlN0xBEEUhb8TAZsBEbARKBGQAV55YCMgAzzwakWADGRgRUAGNoOjempazU/PTFfNrtr7ONN9v3vOvbfFmkNrzs//AWy7VLME5pJmq1D3p6ACiHkPJb2PhbQssn0F3AJvko5TgFiMpEGLU4Bt4KdMvCvpuwkZBQjJbM+BE+BeUlBUi1UA9oEPYClpUkLjECTb0mVXp4e2F8AecCZpnhiCGigAUsr7AKfAE7CQNK1m67LIdhjxLWAqKRTYv2ipC1W7qrbYjgV9SgoWF9E7ZrbvgEvgWVJIUERKge2wMwfR0lzADvBVHp5ICha0wnbnucFFsf0KHAEzSUFRCnADXDeVDlpU2hG2+SU5m+2PredlUEEJiSPbx6k1N6sHmVX3HstV8ACcA4+SLho70fkvqwfVsSwuNF7Q6oannovNUDCmF1kKNhrwC7rGoRm2ijZeAAAAAElFTkSuQmCC" /> Editar pedido</button>
                            <a href="/cancelarP" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-sm-12 mt-3 row">
            <div class="col-sm-12 text-center">
                <a href="/pedido/requisitos" class="titulo alert-link">Agregar otro producto al pedido</a>
            </div>
            {{-- <div class="col-sm-12 centrado mt-3 mb-3" id="mostrarOpciones" style="display: none;">
                <a href="/cotizacion/personalizada" class="btn btn-primary btn-sm mr-3">Agregar personalizado</a>
                <a href="/producto/catalogo" class="btn btn-primary btn-sm">Agregar desde catálogo</a>
            </div> --}}
        </div>
        <div class="col-lg-7 col-sm-12 mt-3">
            <p>{{ count(Cart::getContent())}} Producto(s) en el pedido</p>
            @else
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <p>No hay productos en tu carrito</p>
                        <div class=" col-12 centrado">
                            <a href="/pedido/requisitos" class="btn btn-primary">¡Haz tu pedido!</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @foreach($carritoCollection as $item)
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <img src="/imagenes/{{ $item->attributes->img }}" class="img-thumbnail" width="200" height="200">
                </div>
                <div class="col-lg-5 col-sm-12">
                    <p>
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <b><a href="#"  role="button" class="titulo"  onclick="mostrar({{$item->id}})" data-toggle="tooltip" data-placement="right" title="Clic para editar el producto">{{ $item->name }}</a></b><br>
                        <b>Sabor: </b>{{ $item->attributes->saborDeseado }}
                    </p>
                </div>
            </form>
                <div class="col-lg-4 col-sm-12">
                    <div class="row">
                        <form action="/quitarProducto" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                            <button class="btn btn-dark btn-sm" style="margin-right: 25px;"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
        @if(count($carritoCollection)>0)
        <div class="col-lg-5 col-sm-12 mt-3" id="imagen" style="display: none;">
            <div class="mostrar">
                <div class="card">
                    <div class="card-header text-center">
                        <strong id="nombre"></strong>
                    </div>
                    <div class="card-body">
                        <form action="/actualizarProductosPedido" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="idUser" value="{{$pedido->idUser}}" />
                            <input type="hidden" id="idProducto" value="" name="id">
                            {{-- <input type="text" id="id" value="" name="id"> --}}
                            <div class="form-group col-md-12">
                                <label for="">Sabor deseado: <b style="color: red"> *</b> </label>
                                <input type="text" class="form-control form-control-sm " id="sabor" value="" name="saborDeseado">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Para número de personas: <b style="color: red"> *</b></label>
                                <input type="number" class="form-control form-control-sm" id="nPersonas" value="" name="numeroPersonas">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Pisos: <b style="color: red"> *</b></label>
                                <input type="number" class="form-control form-control-sm" id="pisos" value="" name="pisos">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Frase: </label>
                                <input type="text" class="form-control form-control-sm" id="frase" value="" name="frase" placeholder="Escribe la frase de tu pastel aquí">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Descripción: <b style="color: red"> *</b></label>
                                <input type="text" class="form-control form-control-sm" id="descripcionProducto" value="" name="descripcionProducto">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Foto de referencia: </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input peque" name="img"
                                    onchange="vista_preliminar(event)">
                                    <label class="custom-file-label peque" for="customFile">Subir foto del pastel</label>
                                </div>
                                {{-- <input type="file" class="form-control-file" name="img" value="" onchange="vista_preliminar(event)"> --}}
                                {{-- <input type="hidden" name="imagenJs" id="imagenJs" value=""> --}}
                                <p id="foto"></p>
                                <p>
                                    <img src="" id="imagen1" width="300;">
                                </p>
                            </div>
                            <div class="centrado">
                                <button class="btn btn-dark btn-sm mb-3">Actualizar datos del producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
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
                    $('#sabor').val(res.attributes.saborDeseado);
                    $('#idProducto').val(res.id);
                    $('#nPersonas').val(res.attributes.numeroPersonas);
                    $('#pisos').val(res.attributes.pisos);
                    if (res.attributes.frase==null) {
                        $('#frase').val('');
                    }else {
                        $('#frase').val(res.attributes.frase);
                    }
                    $('#descripcionProducto').val(res.attributes.descripcionProducto);
                    if (res.attributes.imagen1==null) {
                        $('#imagen1').attr("src","");
                        $('#foto').html("No tiene imágenes");
                    }else {
                        $('#foto').html("");
                        let imagen= "/imagenes/"+res.attributes.imagen1;
                        // $('#img').val(imagen);
                        // $('#imagenJs').val(imagen);
                        $('#imagen1').attr("src",imagen);
                    }
                },
            });
    }
    let vista_preliminar = (event) => {
        let leer_img = new FileReader();
        let id_img = document.getElementById('imagen1');
        leer_img.onload = () => {
            if (leer_img.readyState == 2) {
                id_img.src = leer_img.result
            }
        }
        leer_img.readAsDataURL(event.target.files[0])
    }    
    function agregarProductos() {
        $("#mostrarOpciones").toggle();
    }
    function mostrarPrecio(id) {
        console.log(id);
        if (id==3) {
            $("#precio").show();
        } else if (id==2) {
            $("#precio").hide();
        } else if (id==1) {
            $("#precio").hide();
        } else if (id==null) {
            $("#precio").hide();
        }
    }
    function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
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
    let precio = $('#precio').val();
     $('#precio').val(number_format(precio, 0, '.', '.'));

    $("#precio").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
        
    });
    
</script>
@endsection