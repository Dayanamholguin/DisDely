@extends('layouts.menu')
@section('titulo')
Productos
@endsection
@section('content')
<div class="album py-2 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card text-center shadow-sm">
                   
                        @foreach($productos as $productos)
                        <img src="/imagenes/{{$productos->img}}" width="300" height="300">
                        <strong>
                            <p class="card-title">{{ $productos->nombre}}</p>
                        </strong>
                        <a href="{{ url('añadirCarrito/'.$productos->id) }}" class="btn boton my-2" role="button" aria-pressed="true"><i class="fas fa-shopping-cart"></i> Añadir al carrito</a>
                        <a href="{{ url('detalleProducto/'.$productos->id) }}" class="btn boton my-2" role="button" aria-pressed="true">Detalle</a>
                        @endforeach                   
                   
                </div>
            </div>
            <!--<div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div><div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                        <img src="/img/pastel.png">
                            <div class="card-body">
                                <p class="card-title">Torta de Chocolate</p>
                                <button class="btn boton my-2" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                <a href="#" class="btn boton my-2">Ver</a>
                            </div>
                        </div>
                    </div>-->
        </div>
    </div>
</div>
@endsection