@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="card">
            <div class="card-header text-center">
                <strong>Detalle de la cotización</strong> / <a href="/cotizacion" class="alert-link titulo">Volver</a>
            </div>
            @include('flash::message')
            <div class="card-body text-center">
                <div class="row">
                    @if($nombreEstado =="Aprobada")
                        <div class="col-md-12 col-sm-12 text-center p-3">
                            <p>Recuerda que la si la cotización está aprobada, ya se considera un pedido. 
                                @can('pedido/ver')
                                <br>Para mirarlo con más detalle   
                                <a href="/pedido/ver/{{$cotizacion->id}}" class="alert-link titulo">Clic aquí</a>
                                @endcan
                            </p>
                        </div>
                    @else
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Persona que hizo la cotización</strong></label>
                                <p  class="form-control">{{$cotizacionUsuario}}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Fecha de entrega</strong></label>
                                <p class="form-control">{{ucwords(Date::create($cotizacion->fechaEntrega)->format('l, j F Y'))}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Estado de la cotización</strong></label>
                                @if ($nombreEstado =="Pendiente")
                                    <p class="form-control bg-secondary text-white" >{{$nombreEstado}}</p>
                                @elseif($nombreEstado =="Aprobada")
                                    <p class="form-control bg-success text-white" >{{$nombreEstado}}</p>
                                @elseif($nombreEstado =="Rechazada")
                                    <p class="form-control bg-danger text-white" >{{$nombreEstado}}</p>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for=""><strong>Descripción de la cotización</strong></label>
                                <p class="textarea form-control" >{{$cotizacion->descripcionGeneral}}</p>
                                {{-- <textarea  style="width: 100%;">/> --}}
                            </div>
                        </div>
                        @can('cotizacion/editar')
                            @if ($nombreEstado ==="Pendiente")
                                <div class="col-md-12 col-sm-12 text-right">
                                    <a href="/cotizacion/editar/{{$cotizacion->id}}" class="alert-link titulo">Editar cotización</a>
                                </div>
                            @endif
                        @endcan
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group mt-3 mb-3">
                                <label for=""><strong>Información de los productos que se encuentran en la cotización</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center ">
                                @foreach($detalleCotizacion as $value)
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
                            @foreach($detalleCotizacion as $value)
                            <p class="card-text">Número de personas: {{$value->numeroPersonas}}</p>
                            <p class="card-text">Pisos: {{$value->pisos}}</p>
                            <p class="card-text">Sabor: {{$value->saborDeseado}}</p>
                            <p class="card-text">Frase: {{$value->frase==null?'No tiene frase':$value->frase}}</p>
                            <p class="card-text">Descripción: {{$value->descripcionProducto}}</p>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @endif
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
            // $.get('/producto/verProductoAjax/'+id, function (producto) {
                
            //     $('#verProducto').modal('toggle');
                
            //     let imagen= "/imagenes/"+res.attributes.imagen1;
            //         $('#img').val(imagen);
            //         $('#imagenJs').val(imagen);
            //     $('#imagen1').attr("src",imagen);
            //     $('#nombre').html(producto.nombre);
            //     $('#categoria').html(producto.categoria);
            // })
           
        }
  </script>
@endsection