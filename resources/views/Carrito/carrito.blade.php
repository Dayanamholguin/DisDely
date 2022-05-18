@extends('layouts.app')
@section('car')
@include('carrito.icono')
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Carrito para hacer cotización</strong> / <a href="/producto/catalogo" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="#" method="post">
            @csrf
            <input type="hidden" name="id" value="Auth()->user()->id" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Cliente que hace la cotización<b style="color: red"> *</b></label>
                        <input type="text" readonly value="{{Auth()->user()->nombre}}" class="form-control" id="productoNombre" name="productoNombre" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Fecha de entrega<b style="color: red"> *</b></label>
                        <input id="fechaEntrega" type="date" value="" class="form-control @error('fechaEntrega') is-invalid @enderror" name="fechaEntrega" required autocomplete="fechaEntrega" />
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
                        <textarea type="text" value="{{ old('descripcionGeneral') }}" class="form-control @error('descripcionGeneral') is-invalid @enderror" id="descripcionGeneral" name="descripcionGeneral" placeholder="Ingrese la descripción" required>{{ old('descripcionGeneral') }}</textarea>
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
        </form>
    </div>
</div>
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-auto">
            @include('flash::message')
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-sm-12">
            @if(\Cart::getTotalQuantity()>0)
            <h4>{{ count(Cart::getContent())}} Producto(s) en el carrito</h4><br>
            @else
            <h4>No Product(s) In Your Cart</h4><br>
            <a href="/" class="btn btn-dark">Continue en la tienda</a>
            @endif
            @foreach($carritoCollection as $item)

            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <img src="/imagenes/{{ $item->attributes->img }}" class="img-thumbnail" width="200" height="200">
                </div>
                <div class="col-lg-5">
                    <p>
                        <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                        <!-- <b>Price: </b>${{ $item->price }}<br> -->
                        <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                        {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <form action="/actualizarCarrito" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}" id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                                <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                            </div>
                        </form>
                        <form action="/quitarProducto" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                            <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
            @if(count($carritoCollection)>0)
            <form action="/limpiarCarrito" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-secondary btn-md">Limpiar Carrito</button>
            </form>
            @endif
        </div>
        @if(count($carritoCollection)>0)
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }}</li>
                </ul>
            </div>
            <br><a href="/shop" class="btn btn-dark">Continue en la tienda</a>
            <a href="/checkout" class="btn btn-success">Proceder al Checkout</a>
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
@endsection