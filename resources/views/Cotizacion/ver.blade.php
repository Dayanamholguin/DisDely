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
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for=""><b>Persona que hizo la cotización</b></label>
                            <p  class="form-control">{{$cotizacionUsuario}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for=""><b>Fecha de entrega</b></label>
                            <p class="form-control">{{$cotizacion->fechaEntrega}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for=""><b>Estado de la cotización</b></label>
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
                            <label for=""><b>Descripción de la cotización</b></label>
                            <p class="textarea form-control" >{{$cotizacion->descripcionGeneral}}</p>
                            {{-- <textarea  style="width: 100%;">/> --}}
                        </div>
                    </div>
                    @if ($nombreEstado ==="Pendiente")
                        <div class="col-md-12 col-sm-12 text-right">
                            <a href="/cotizacion/editar/{{$cotizacion->id}}" class="alert-link titulo">Editar cotización</a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group mt-3 mb-3">
                            <label for=""><b>Información de los productos que se encuentran en la cotización</b></label>
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
                                    <b>Producto {{ $value->producto}}</b>
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
                        <p class="card-text">frase: {{$value->frase==null?'No tiene frase':$value->frase}}</p>
                        <p class="card-text">Descripción: {{$value->descripcionProducto}}</p>
                        <hr>
                        @endforeach
                        
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="centrado mb-3">
                            <a href="/cotizacion" class="btn btn-primary tipoletra">Volver</a>
                        </div>
                    </div> --}}
                   
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection