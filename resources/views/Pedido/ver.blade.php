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
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="card">
                <div class="card-header text-center">
                    <strong>Detalle del pedido</strong> / <a href="/pedido" class="alert-link titulo">Volver</a>
                </div>
                @include('flash::message')
                <div class="card-body text-center">
                    @if ($pedido->idUser!=1)
                        <div class="d-flex justify-content-between align-items-center">
                            <a><strong>Información del cliente: </strong></a>
                            @can('usuario/ver')
                                <a href="/usuario/ver/{{$pedido->idUser}}" class="alert-link titulo">Ver información del cliente detalladamente</a>
                            @endcan
                        </div>
                    @endif
                    <div class="row {{$pedido->idUser!=1?'mt-4':''}} ">
                        @foreach($cliente as $item)
                            
                            @if ($item->id==1)
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><strong>Persona responsable del pedido</strong></label>
                                        <p  class="form-control">{{$item->nombre}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><strong>Persona responsable del pedido</strong></label>
                                        <p  class="form-control">{{$item->nombre ." ". $item->apellido}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><strong>Correo electrónico</strong></label>
                                        <p  class="form-control">{{$item->email}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><strong>Teléfono</strong></label>
                                        <p  class="form-control">{{$item->celular}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><strong>Teléfono alternativo</strong></label>
                                        <p  class="form-control">{{$item->celularAlternativo}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <a><strong>Información del pedido: </strong></a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Fecha de entrega</strong></label>
                                <p class="form-control">{{ucwords(Date::create($pedido->fechaEntrega)->format('l, j F Y'))}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Precio del pedido</strong></label>
                                <p class="form-control">{{number_format($pedido->precio, 0, '.', '.');}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Estado del pedido</strong></label>
                                @if ($nombreEstado =="En espera")
                                    <p class="form-control bg-secondary text-white" >{{$nombreEstado}}</p>
                                @elseif($nombreEstado =="En proceso")
                                    <p class="form-control bg-warning text-white" >{{$nombreEstado}}</p>
                                @elseif($nombreEstado =="Entregado")
                                    <p class="form-control bg-success text-white" >{{$nombreEstado}}</p>
                                @elseif($nombreEstado =="Anulado")
                                    <p class="form-control bg-danger text-white" >{{$nombreEstado}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Descripción del pedido</strong></label>
                                <p class="border p-3" >{{$pedido->descripcionGeneral}}</p>
                                {{-- <textarea  style="width: 100%;">/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a><strong>Información de los abonos: </strong></a>
                        <a href="/abono/ver/{{$pedido->id}}" class="alert-link titulo">Ver detalladamente</a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Porcentaje del pago:</strong></label>
                                <p class="form-control">{{$porcentaje}} %</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Estado del pedido en el abono:</strong></label>
                                @if ($paga)
                                    <p class="form-control bg-success text-white" >Pedido pago</p>
                                @else
                                    <p class="form-control bg-warning text-white" >Proceso de abono</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Información de los productos que se encuentran en el pedido</strong>
                        @can('pedido/editar')
                            @if ($nombreEstado ==="En espera" || $nombreEstado ==="En proceso")
                                <a href="/pedido/editar/{{$pedido->id}}" class="alert-link titulo">Editar pedido</a>
                            @endif
                        @endcan
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center ">
                                @foreach($detallePedidos as $value)
                                <img src="{{$value->img==null?'/img/defecto.jpg':'/imagenes/'.$value->img}}" class="rounded-circle mt-4" width="130" height="100" alt="{{$value->img==null?'No tiene imagen de referencia':''}}" data-toggle="tooltip" data-placement="bottom" title="{{$value->img==null?'No tiene imagen de referencia':'Foto de referencia'}}">
                                    <div class="mt-3">
                                        <a href="javascript:void(0)" class="alert-link titulo"  onclick="mostrarVentana({{$value->idProducto}})" data-toggle="tooltip" data-placement="bottom" title="Clic para ver información del porducto">Producto {{ $value->producto}}</a>
                                        <hr>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" >
                            @foreach($detallePedidos as $value)
                            <p><strong class="card-text">Pastel: {{$value->producto}}</strong></p>
                            <p class="card-text">Número de personas: {{$value->numeroPersonas}}</p>
                            <p class="card-text">Pisos: {{$value->pisos}}</p>
                            <p class="card-text">Sabor: {{$value->saborDeseado}}</p>
                            <p class="card-text">Frase: {{$value->frase==null?'No tiene frase':$value->frase}}</p>
                            <p class="card-text">Descripción: {{$value->descripcionProducto}}</p>
                            @if ($value->img!=null)
                            <div class="portfolio-img">
                                <a href="/ver/imagenPedido/{{$value->img}}" data-gall="portfolioGallery" class="venobox preview-link titulo alert-link" title="{{$value->nombre}}"><i class="fas fa-eye"></i> Ver imagen de referencia</a>
                                {{-- <a href="/ver/imagenPedido/{{$value->img}}" data-gall="portfolioGallery" class="btn btn-primary" title="{{$value->nombre}}"><i class="fas fa-eye"></i> Ver imagen de referencia</a> --}}
                            </div>
                            @else
                            <p class="card-text">No tiene imágenes de referencia este pastel del pedido</p>
                            @endif
                            
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- Modal -->
    <div class="modal fade" id="verProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header">
            <h5 class="modal-title" id="nombre"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> --}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img src="" id="imagen1" class="rounded-circle mt-4" width='250px' height='250px' alt="Imagen producto">
                                <div class="mt-3">
                                    <h4 id="nombre"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="text-center">
                            <strong>Ver información del producto</strong>
                        </div>
                        <hr>
                            <p class="card-text" id="categoria"> </p>
                            <p class="card-text" id="sabor"> </p>
                            <p class="card-text" id="etapa"> </p>
                            <p class="card-text" id="descripcion"> </p>
                            <hr>
                            <p>Para cuántas personas se hizo este pastel</p>
                            <hr>
                            <p class="card-text" id="numeroPersonas"> </p>
                            <p class="card-text" id="pisos"> </p>
                        
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
      function mostrarVentana(id){
        $('#verProducto').modal('toggle');
        $.ajax({
                url: `/producto/verProductoAjax/${id}`,
                type: "GET",
                success: function (res) {
                    let imagen
                    console.log(res.producto.img);
                    $('#nombre').html('Producto '+res.producto.nombre);
                    if (res.producto.img==null) {
                        imagen= "/img/defecto.jpg";
                    }else {
                        imagen = "/imagenes/"+res.producto.img;
                    }
                    // $('#img').val(imagen);
                    $('#imagen1').attr("src",imagen);
                    $('#categoria').html('<strong> Categoria: </strong>'+res.categoria);
                    $('#sabor').html('<strong> Sabor: </strong>'+res.sabor);
                    $('#etapa').html('<strong> Etapa: </strong>'+res.etapa);
                    $('#descripcion').html('<strong> Descripción: </strong>'+res.producto.descripcion);
                    $('#numeroPersonas').html('<strong> Número de personas: </strong>'+res.producto.numeroPersonas);
                    $('#pisos').html('<strong> Pisos: </strong>'+res.producto.pisos);
                },
            });
        }
  </script>
@endsection