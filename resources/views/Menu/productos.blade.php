@extends('layouts.menu')
@section('titulo')
Productos
@endsection
@section('content')
<div class="galeria" style="margin:0;
    padding: 0;
    box-sizing: border-box;">
    <div class="linea"></div>
    @foreach($productos as $productos)
    <div class="contenedor-imagenes">
        <div class="imagen">
            <img src="/imagenes/{{$productos->img}}" class="responsive-img">
            <div class="overlay text-center">
                <strong>
                    <p class="card-title">{{ $productos->nombre}}</p>
                </strong>
                <a href="{{ url('añadirCarrito/'.$productos->id) }}" class="btn boton my-2" role="button" aria-pressed="true"><i class="fas fa-shopping-cart"></i> Añadir al carrito</a>
                <a href="{{ url('detalleProducto/'.$productos->id) }}" class="btn boton my-2" role="button" aria-pressed="true">Detalle</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection