@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear producto</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/producto/guardar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Categoría<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="categoria">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                            <option value="{{ $value->id }}" {{old('categoria' ) == $value->id ? 'selected' : ''}}>
                                {{ $value->nombre }}</option>
                            @endforeach
                            
                        </select>
                        @error('categorias')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                    </div>

                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="sabor">
                            <option value="">Seleccione</option>
                            @foreach($sabores as $key => $value)
                            <option value="{{$value->id}}" {{old('sabor' ) == $value->id ? 'selected' : ''}}>
                                {{$value->nombre}}</option>
                            @endforeach
                            
                        </select>
                        @error('sabores')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Etapa<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="etapa">
                            <option value="">Seleccione</option>
                            @foreach($etapas as $key => $value)
                            <option value="{{$value->id}}" {{old('etapa' ) == $value->id ? 'selected' : ''}}>
                                {{$value->nombre}}</option>
                            @endforeach
                           
                        </select>
                        @error('etapas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Nombre<strong style="color: red"> *</strong></label>
                        <input type="text" value="{{ old('nombre') }}"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                            placeholder="Ingrese el nombre" required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<strong style="color: red"> *</strong></label>
                        <textarea type="text" value="{{ old('descripcion') }}"
                            class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                            name="descripcion" placeholder="Ingrese la descripción"
                            required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Imagen<b style="color: red"> *</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror" name="imagen"
                            id="imagen">
                            <label class="custom-file-label" for="customFile">Subir foto del pastel</label>
                        </div>
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Número de personas<strong style="color: red"> *</strong></label>
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<strong style="color: red"> *</strong></label>
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Desea añadirlo al catálogo?<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="catalogo">
                            <option value="" selected>Seleccione</option>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/producto" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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
                nombre: {
                    // espaciosycaracteres: true,
                    letras:true,
                    required: true,
                    maxlength:100
                },
                pisos: {
                    numeros:true,
                    required: true,
                    cero: true,
                    max:99
                },
                numeroPersonas: {
                    required: true,
                    numeros: true, 
                    min:10,
                    max:1000
                },
                descripcion: {
                    required: true, 
                    minlength: 20,
                    maxlength:500
                },
                imagen: {
                    required: true,
                },
                categoria: {
                    required: true,
                },
                sabor: {
                    required: true,
                },
                etapa: {
                    required: true,
                },
                catalogo: {
                    required: true,
                }
            },
        });
    });
</script>
@endsection