@extends('layouts.app')

@section('title')
Pedidos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Registro de pedido</strong> 
    </div>
    <div class="card-body">
        @include('flash::message')
        
        <form id="form" action="/agregarCarritoPedido" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="idProducto" value="{{$producto->id}}" /> --}}
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <input type="hidden" name="idUser" value="{{$cliente->id}}" />
                    <label for="">Cliente que hace el pedido<b style="color: red"> *</b></label>
                    <input type="text" readonly value="{{$cliente->id==1?$cliente->nombre:$cliente->nombre ." ".$cliente->apellido }}" class="form-control @error('nombreCliente') is-invalid @enderror" id="nombreCliente" name="nombreCliente" required>
                    @error('nombreCliente')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input type="hidden" name="idProducto" value="{{$producto->id}}" />
                        <label for="">Producto<b style="color: red"> *</b></label>
                        <input type="text" readonly value="{{$producto->nombre}}" class="form-control" id="productoNombre" name="productoNombre" required>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor deseado<b style="color: red"> *</b></label>
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
                        <label for="">¿Para cuántas personas?<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('numeroPersonas') }}" class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas" name="numeroPersonas" placeholder="Ingrese número de personas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('pisos') }}" class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<b style="color: red"> *</b></label>
                        <textarea type="text" value="{{ old('descripcionProducto') }}" class="form-control @error('descripcionProducto') is-invalid @enderror" id="descripcionProducto" name="descripcionProducto" placeholder="Ingrese la descripción" required>{{ old('descripcionProducto') }}</textarea>
                        @error('descripcionProducto')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                
                @if ($producto->id==1)
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Agregar fotos de referencia<strong style="color: red"> *</strong></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img" id="img">
                                <label class="custom-file-label" for="customFile">Subir foto del pastel aquí</label>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="">Agregar fotos de referencia<strong style="color: red"> *</strong></label>
                            <select class="form-control" onchange="mostrar(this.value);">
                                <option value="No">No</option>
                                <option value="imagen">Sí</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12"  id="imagen" style="display: none;">
                        <div class="form-group">
                            <label for="">Inserte imagen de referencia acá</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img" id="img">
                                <label class="custom-file-label" for="customFile">Subir foto del pastel aquí</label>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUxJREFUSEvNlN0xBEEUhb8TAZsBEbARKBGQAV55YCMgAzzwakWADGRgRUAGNoOjempazU/PTFfNrtr7ONN9v3vOvbfFmkNrzs//AWy7VLME5pJmq1D3p6ACiHkPJb2PhbQssn0F3AJvko5TgFiMpEGLU4Bt4KdMvCvpuwkZBQjJbM+BE+BeUlBUi1UA9oEPYClpUkLjECTb0mVXp4e2F8AecCZpnhiCGigAUsr7AKfAE7CQNK1m67LIdhjxLWAqKRTYv2ipC1W7qrbYjgV9SgoWF9E7ZrbvgEvgWVJIUERKge2wMwfR0lzADvBVHp5ICha0wnbnucFFsf0KHAEzSUFRCnADXDeVDlpU2hG2+SU5m+2PredlUEEJiSPbx6k1N6sHmVX3HstV8ACcA4+SLho70fkvqwfVsSwuNF7Q6oannovNUDCmF1kKNhrwC7rGoRm2ijZeAAAAAElFTkSuQmCC" /> Añadir producto al pedido</button>
                </div>
            </div>
        </form>
        <div class="text-center col-md-12 mt-3">
            <a href="/pedido/requisitos" class="titulo">Volver</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // falta img
        // $("#descripcionProducto,  #saborDeseado").focusout(function(event) {
        //     if ($(this).val().length > 0) {
        //         $(this).addClass("is-valid").removeClass("is-invalid");
        //         $(this).rules('remove');
        //     } else {
        //         $(this).valid();
        //         $(this).addClass("is-invalid").removeClass("is-valid");
        //     }
        // });
        // $("#pisos, #numeroPersonas").focusout(function(event) {
        //     if ($(this).val() > 0) {
        //         $(this).addClass("is-valid").removeClass("is-invalid");
        //         $(this).rules('remove');
        //     } else {
        //         $(this).valid();
        //         $(this).addClass("is-invalid").removeClass("is-valid");
        //     }
        // });
        // $.validator.addMethod("espaciosVacios", function (value, element) {
        //     var pattern = $(this).val().trim().length > 0;
        //     return this.optional(element) || pattern.test(value);
        // }, "El campo no debe tener datos vacíos");
        // $("#saborDeseado").blur(function(){ 
        //     $(this).val().trim(); 
        // }, "El campo no debe tener datos vacíos");
        
        $.validator.addMethod("numeros", function (value, element) {
            var pattern = /^[0-9]+$/;
            return this.optional(element) || pattern.test(value);
        }, "Solo digite números positivos, por favor");
        jQuery.validator.addMethod("cero", function(value, element) {
            return this.optional(element) || parseInt(value) > 0;
        }, "Debe ser mayor a cero");
        $.validator.addMethod("letras", function (value, element) {
            var pattern = /^[0-9a-zA-Z-áéíóúÁÉÍÓÚÜüñÑ]+$/;
            return this.optional(element) || pattern.test(value);
        }, "No se admite caracteres especiales ni espacios vacíos ni al inicio ni al final");
        jQuery.validator.addMethod("espaciosycaracteres", function(value, element) {
            return this.optional(element) || (((value).trim().length > 0) && (value).length > 4);
        }, "No dejar espacios vacíos en el campo y mayor a 5 caracteres");
        $('#form').validate({
        rules: {
            frase: {
                minlength: 10
            },
            saborDeseado: {
                espaciosycaracteres: true,
                letras:true,
                required: true,
                maxlength:100
            },
            pisos: {
                numeros:true,
                required: true,
                cero: true,
            },
            numeroPersonas: {
                required: true,
                numeros: true, 
                min:10
            },
            descripcionProducto: {
                required: true, 
                minlength: 20,
                maxlength:1200
            },
            img: {
                required: true,
            }
        },
        });
    });
    function mostrar(id) {
        if (id == "imagen") {
            $("#imagen").show();
        } else {
            $("#imagen").hide();
        }
    }
</script>

@endsection