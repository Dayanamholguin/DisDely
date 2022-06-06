@extends('layouts.app')

@section('title')
Cotización
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Registro de cotización</strong> 
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/agregarCarrito" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idProducto" value="{{$producto->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Producto<strong style="color: red"> *</strong></label>
                        <input type="text" readonly value="{{$producto->nombre}}" class="form-control" id="productoNombre" name="productoNombre" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor deseado<strong style="color: red"> *</strong></label>
                        <input type="text" value="{{ old('saborDeseado') }}" class="form-control @error('saborDeseado') is-invalid @enderror" id="saborDeseado" name="saborDeseado" placeholder="Ingrese el sabor deseado" required>
                        @error('saborDeseado')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Para cuántas personas?<strong style="color: red"> *</strong></label>
                        <input type="number" value="{{ old('numeroPersonas') }}" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" placeholder="Ingrese número de personas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Frase si desea</label>
                        <input type="text" value="{{ old('frase') }}" class="form-control @error('frase') is-invalid @enderror" id="frase" name="frase" placeholder="Ingrese la frase que desea">
                        @error('frase')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<strong style="color: red"> *</strong></label>
                        <input type="number" value="{{ old('pisos') }}" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<strong style="color: red"> *</strong></label>
                        <textarea type="text" value="{{ old('descripcionProducto') }}" class="form-control @error('descripcionProducto') is-invalid @enderror" id="descripcionProducto" name="descripcionProducto" placeholder="Ingrese la descripción" required>{{ old('descripcionProducto') }}</textarea>
                        @error('descripcionProducto')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Agregar fotos de referencia<strong style="color: red"> *</strong></label>
                        <select class="form-control" onchange="mostrar(this.value);">
                            <option value="No">No</option>
                            <option value="imagen">Sí</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 centrado"  id="imagen" style="display: none;">
                    <div class="form-group">
                        <label for="">Inserte imagen de referencia acá</label>
                        <input type="file" class="form-control-file" name="img" id="img">
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUxJREFUSEvNlN0xBEEUhb8TAZsBEbARKBGQAV55YCMgAzzwakWADGRgRUAGNoOjempazU/PTFfNrtr7ONN9v3vOvbfFmkNrzs//AWy7VLME5pJmq1D3p6ACiHkPJb2PhbQssn0F3AJvko5TgFiMpEGLU4Bt4KdMvCvpuwkZBQjJbM+BE+BeUlBUi1UA9oEPYClpUkLjECTb0mVXp4e2F8AecCZpnhiCGigAUsr7AKfAE7CQNK1m67LIdhjxLWAqKRTYv2ipC1W7qrbYjgV9SgoWF9E7ZrbvgEvgWVJIUERKge2wMwfR0lzADvBVHp5ICha0wnbnucFFsf0KHAEzSUFRCnADXDeVDlpU2hG2+SU5m+2PredlUEEJiSPbx6k1N6sHmVX3HstV8ACcA4+SLho70fkvqwfVsSwuNF7Q6oannovNUDCmF1kKNhrwC7rGoRm2ijZeAAAAAElFTkSuQmCC" /> Añadir producto a cotización</button>
                </div>
            </div>
        </form>
        <div class="text-center col-md-12 mt-3">
            <a href="/producto/catalogo" class="titulo">Volver</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function mostrar(id) {
        if (id == "imagen") {
            $("#imagen").show();
        } else {
            $("#imagen").hide();
        }
    }
</script>

@endsection