@extends('layouts.app')

@section('title')
Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear sabor</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/sabor/guardar" method="post">
            @csrf
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                    title="Requerido"> *</b></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                name="nombre" placeholder="Ingrese el sabor" required>
                            @error('nombre')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                            <a href="/sabor" class="btn btn-primary tipoletra">Volver</a>
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
$.validator.addMethod("letras", function(value, element) {
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
            letras: true,
            required: true,
            maxlength: 100
        }
    },
});
</script>
@endsection