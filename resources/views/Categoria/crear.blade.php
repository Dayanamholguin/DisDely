@extends('layouts.app')

@section('title')
Categoria
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear categoría</strong> 
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/categoria/guardar" method="post">
            @csrf
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre<strong style="color: red"> *</strong></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ingrese la categoría" required>
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                            <a href="/categoria" class="btn btn-primary tipoletra">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("letras", function (value, element) {
            var pattern = /^[0-9a-zA-Z-áéíóúÁÉÍÓÚÜüñÑ]+$/;
            return this.optional(element) || pattern.test(value);
        }, "No se admite caracteres especiales ni espacios vacíos ni al inicio ni al final");
        jQuery.validator.addMethod("espaciosycaracteres", function(value, element) {
            return this.optional(element) || (((value).trim().length > 0) && (value).length > 4);
        }, "No dejar espacios vacíos en el campo y mayor a 5 caracteres");
        $('#form').validate({
            rules: {
                nombre: {
                    espaciosycaracteres: true,
                    letras:true,
                    required: true,
                    maxlength:100
                }
            },
        });
    });
</script>
@endsection