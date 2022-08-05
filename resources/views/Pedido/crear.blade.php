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
                <div class="card-body d-flex justify-content-start">
                    <a href="/pedido/requisitos" class="btn btn-primary mr-3">Volver</a>
                </div>
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </div>
            </div>
        </form>
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
            var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
            return this.optional(element) || pattern.test(value);
        }, "No se admite caracteres especiales ni espacios vacíos ni al inicio ni al final");
        jQuery.validator.addMethod("espaciosycaracteres", function(value, element) {
            return this.optional(element) || (((value).trim().length > 0) && (value).length > 3);
        }, "No dejar espacios vacíos en el campo y mayor a 3 caracteres");
        $('#form').validate({
        rules: {
            frase: {
                minlength: 10
            },
            saborDeseado: {
                // espaciosycaracteres: true,
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
                maxlength:500
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