@extends('layouts.app')

@section('title')
Cotización
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Registro de producto para la cotización</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/agregarCarrito" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idProducto" value="{{$producto->id}}" />
            <input type="hidden" name="idUser" value="{{Auth()->user()->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Producto<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" readonly value="{{$producto->nombre}}" class="form-control"
                            id="productoNombre" name="productoNombre" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor deseado<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" value="{{ old('saborDeseado') }}"
                            class="form-control @error('saborDeseado') is-invalid @enderror" id="saborDeseado"
                            name="saborDeseado" placeholder="Ingrese el sabor deseado" required>
                        @error('saborDeseado')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Para cuántas personas?<b style="color: red" data-toggle="tooltip"
                                data-placement="top" title="Requerido"> *</b></label>
                        <input type="number" value="{{ old('numeroPersonas') }}"
                            class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas"
                            name="numeroPersonas" placeholder="Ingrese número de personas" required>
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
                        <input type="text" value="{{ old('frase') }}"
                            class="form-control @error('frase') is-invalid @enderror" id="frase" name="frase"
                            placeholder="Ingrese la frase que desea">
                        @error('frase')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="number" value="{{ old('pisos') }}"
                            class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos"
                            placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <textarea type="text" value="{{ old('descripcionProducto') }}"
                            class="form-control @error('descripcionProducto') is-invalid @enderror"
                            id="descripcionProducto" name="descripcionProducto" placeholder="Ingrese la descripción"
                            required>{{ old('descripcionProducto') }}</textarea>
                        @error('descripcionProducto')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Agregar fotos de referencia<b style="color: red" data-toggle="tooltip"
                                data-placement="top" title="Requerido"> *</b></label>
                        <select class="form-control" onchange="mostrar(this.value)">
                            <option value="No">No</option>
                            <option value="imagen">Sí</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12" id="imagen" style="display: none;">
                    <div class="form-group">
                        <label for="">Inserte imagen de referencia acá</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img">
                            <label class="custom-file-label" for="customFile">Subir foto del pastel aquí</label>
                        </div>
                        {{-- <input type="file" class="form-control-file" name="img" id="img"> --}}
                    </div>
                </div>
                <div class="card-body d-flex justify-content-start">
                    <a href="/producto/catalogo" class="btn btn-primary mr-3">Volver</a>
                </div>
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUxJREFUSEvNlN0xBEEUhb8TAZsBEbARKBGQAV55YCMgAzzwakWADGRgRUAGNoOjempazU/PTFfNrtr7ONN9v3vOvbfFmkNrzs//AWy7VLME5pJmq1D3p6ACiHkPJb2PhbQssn0F3AJvko5TgFiMpEGLU4Bt4KdMvCvpuwkZBQjJbM+BE+BeUlBUi1UA9oEPYClpUkLjECTb0mVXp4e2F8AecCZpnhiCGigAUsr7AKfAE7CQNK1m67LIdhjxLWAqKRTYv2ipC1W7qrbYjgV9SgoWF9E7ZrbvgEvgWVJIUERKge2wMwfR0lzADvBVHp5ICha0wnbnucFFsf0KHAEzSUFRCnADXDeVDlpU2hG2+SU5m+2PredlUEEJiSPbx6k1N6sHmVX3HstV8ACcA4+SLho70fkvqwfVsSwuNF7Q6oannovNUDCmF1kKNhrwC7rGoRm2ijZeAAAAAElFTkSuQmCC" />
                        Añadir producto a cotización</button>
                </div>
            </div>
        </form>
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
$(document).ready(function() {
    $.validator.addMethod("numeros", function(value, element) {
        var pattern = /^[0-9]+$/;
        return this.optional(element) || pattern.test(value);
    }, "Solo digite números positivos, por favor");
    $.validator.addMethod("letras", function(value, element) {
        var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
        return this.optional(element) || pattern.test(value);
    }, "No se admite caracteres especiales ni espacios vacíos ni al inicio ni al final");
    jQuery.validator.addMethod("cero", function(value, element) {
        return this.optional(element) || parseInt(value) > 0;
    }, "Debe ser mayor a cero");
    jQuery.validator.addMethod("espaciosycaracteres", function(value, element) {
        return this.optional(element) || (((value).trim().length > 0) && (value).length > 3);
    }, "No dejar espacios vacíos en el campo y mayor a 3 caracteres");
    $('#form').validate({
        rules: {
            frase: {
                minlength: 10
            },
            saborDeseado: {
                required: true,
                // espaciosycaracteres: true,
                letras: true,
                maxlength: 100
            },
            pisos: {
                numeros: true,
                required: true,
                cero: true,
                max: 99
            },
            numeroPersonas: {
                required: true,
                numeros: true,
                min: 10,
                max: 1000
            },
            descripcionProducto: {
                required: true,
                minlength: 20,
                maxlength: 500
            },
            img: {
                required: true,
            }
        },
    });
});
</script>

@endsection