@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Usuario</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form action="/usuario/guardar" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<strong style="color: red"> *</strong></label>
                        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}"
                            class="form-control @error('nombre') is-invalid @enderror" name="nombre" required
                            autocomplete="nombre" placeholder="Ingrese su nombre" />
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<strong style="color: red"> *</strong></label>
                        <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}"
                            class="form-control @error('apellido') is-invalid @enderror" name="apellido" required
                            autocomplete="apellido" placeholder="Ingrese su apellido" />
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<strong style="color: red"> *</strong></label>
                        <input id="email" type="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" name="email" required
                            autocomplete="email" placeholder="Ingrese su correo electrónico" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celular">Celular<strong style="color: red"> *</strong></label>
                        <input id="celular" type="number" name="celular" value="{{ old('celular') }}"
                            class="form-control @error('celular') is-invalid @enderror" name="celular" required
                            autocomplete="celular" placeholder="Ingrese su teléfono o celular"/>
                        @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="celularAlternativo">Celular alternativo<strong style="color: red">
                                *</strong></label>
                        <input id="celularAlternativo" type="number" name="celularAlternativo"
                            value="{{ old('celularAlternativo') }}"
                            class="form-control @error('celularAlternativo') is-invalid @enderror"
                            name="celularAlternativo" required autocomplete="celularAlternativo"
                            placeholder="Ingrese su teléfono alternativo" />
                        @error('celularAlternativo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="genero">Género<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option value="{{$value->id}}" {{old('genero') == $value->id ? 'selected' : ''}}>
                                {{$value->nombre}}
                            </option>
                            @endforeach
                            @error('generos')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
        $.validator.addMethod("numeros", function (value, element) {
            var pattern = /^[0-9]+$/;
            return this.optional(element) || pattern.test(value);
        }, "Solo digite números positivos, por favor");
        $.validator.addMethod("email", function (value, element) {
          var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
          return this.optional(element) || pattern.test(value);
        }, "Formato del email incorrecto");
        $.validator.addMethod("letras", function (value, element) {
            var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
            return this.optional(element) || pattern.test(value);
        }, "No se admite caracteres especiales");
        
    $('#form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            nombre: {
                letras:true,
                required: true,
                maxlength:100
            },
            apellido: {
                letras:true,
                required: true,
                maxlength:100
            },
            celularAlternativo: {
                required: true,
                numeros: true, 
                minlength:7,
                maxlength:10
            },
            celular: {
                required: true,
                numeros: true, 
                minlength:7,
                maxlength:10
            },
            genero: {
                required: true
            }
        }
    });
    
    function ucfirst(str,force)
        { 
            str=force ? str.toLocaleLowerCase() : str; 
            return str.replace(/(\b)([a-zA-Z])/, 
            function(firstLetter)
            { 
                return firstLetter.toLocaleLowerCase(); 
            }); 
        }
    
    $('#form').validate({
        rules: {
            nombre: {
                mouseout: true,
                required: true,
            },
            apellido: {
                mouseout: true,
                required: true,
            },
            email: {
                mouseout: true,
                required: true,
                email: true
            }
        },
    });



$('input[type="email"]').keyup(function(evt) {
    // force: true to lower case all letter except first 
    var cp_value = ucfirst($(this).val(), true);
    // to capitalize all words 
    //var cp_value= ucwords($(this).val(),true) ; 
    $(this).val(cp_value);
});
</script>

@endsection