@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Detalle de los productos de la cotización</strong>  
    </div>  
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <table id="detallecotizaciones" class="table table-bordered dt-responsive dataTable text-center table-hover" style="width: 100%;">
            <thead class="thead-ligth">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Número de personas</th>
                    <th>Pisos</th>
                    <th>Sabor</th>             
                    <th>frase</th>             
                    <th>Descripción</th>             
                    <th>imagen</th>         
                </tr>
            </thead>
            <tbody>
                @foreach($detalleCotizacion as $value)
                    <tr>
                        <td>{{$value->cotizacionid}}</td>
                        <td>{{$value->producto}}</td>
                        <td>{{$value->numeroPersonas}}</td>
                        <td>{{$value->pisos}}</td>
                        <td>{{$value->saborDeseado}}</td>
                        <td>{{$value->frase==null?'No tiene frase':$value->frase}}</td>
                        <td>{{$value->descripcionProducto}}</td>
                        <td><img src="{{$value->img==null?'':'/imagenes/'.$value->img}}" alt="">{{$value->img==null?'No tiene imagen de referencia':''}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="card-text text-center"><a href="/cotizacion" class="btn btn-primary">Volver</a></p>
    </div>
</div>
@endsection

        {{-- <div class="card-body text-center">
    
                @foreach($detalleCotizacion as $value)
                
                <p class="card-text">Producto: {{$value->producto}}</p>
                <p class="card-text">Imagen: <img src="{{$value->img==null?'':'/imagenes/'.$value->img}}" alt="">{{$value->img==null?'No tiene imagen de referencia':''}}</p>
                <p class="card-text">Número personas: {{$value->numeroPersonas}}</p>
                <p class="card-text">Pisos: {{$value->pisos}}</p>
                <p class="card-text">Sabor: {{$value->saborDeseado}}</p>
                <p class="card-text">frase: {{$value->frase==null?'No tiene frase':$value->frase}}</p>
                <p class="card-text">Descripción: {{$value->descripcionProducto}}</p>                
                @endforeach
                <p class="card-text"><a href="/cotizacion" class="btn btn-primary sm">Volver</a></p>
        </div>
       
    </div>    
</div>
  --}}