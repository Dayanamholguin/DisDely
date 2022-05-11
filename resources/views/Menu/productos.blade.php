@extends('layouts.menu')
@section('titulo')
Productos
@endsection
@section('content')
<div class="linea"></div>
<div class="contenedor-imagenes container-fluid">
        <!-- @foreach($productos as $productos)
        <div class="imagen">
            <img src="/imagenes/{{$productos->img}}" class="responsive-img">
            <div class="overlay centrado">
                <div class="row text-center centrado">
                    <div class="col-12">
                        <strong>
                            <p class="card-title">{{ $productos->nombre}}</p>
                        </strong>
                    </div>
                    <div class="col-6">
                        <a href="{{ url('añadirCarrito/'.$productos->id) }}" class="btn boton " role="button" aria-pressed="true"><i class="fas fa-shopping-cart"></i></a>
                        <a href="{{ url('detalleProducto/'.$productos->id) }}" class="btn boton" role="button" aria-pressed="true"><i class="fa fa-search"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div> -->

        <div class="row">
            <div class="col-md-12">
                @foreach($productos as $productos)
                    <div class="row text-center centrado">
                        <div class="col-12">
                            <strong>
                               <p class="card-title">{{ $productos->nombre}}</p>
                            </strong>
                        </div>
                        <div class="imagen"> 
                            <img class="prueba" src="/imagenes/{{$productos->img}}" > 
                            <a href="{{ url('detalleProducto/'.$productos->id) }}"><i class="fa fa-search fa-3x"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
@endsection