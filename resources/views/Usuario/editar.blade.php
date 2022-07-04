@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar Usuario</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/usuario/actualizar/{{$usuario->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$usuario->id}}" />
            <div class="row">
                <!--<div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <img src="/imagenes/{{$usuario->img}}" class="imagen" width='180px' height='150px'>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="img" id="imagen">
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div> -->
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<strong style="color: red"> *</strong></label>
                        <input value="{{$usuario->nombre}}" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                            required
                            pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<strong style="color: red"> *</strong></label>
                        <input value="{{$usuario->apellido}}" type="text"
                            class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido"
                            require
                            pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                        @error('apellido')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<strong style="color: red"> *</strong></label>
                        <input value="{{$usuario->email}}" type="text"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="celular">Teléfono celular<strong style="color: red"> *</strong></label>
                        <input value="{{$usuario->celular}}" type="number"
                            class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular"
                            required minlength="7" maxlength="10">
                        @error('celular')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="celularAlternativo">Celular alternativo<strong style="color: red">
                                *</strong></label>
                        <input value="{{$usuario->celularAlternativo}}" type="number"
                            class="form-control @error('celularAlternativo') is-invalid @enderror"
                            id="celularAlternativo" name="celularAlternativo" required minlength="7" maxlength="10">
                        @error('celularAlternativo')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                @if ($usuarioEnSesion->hasRole('Admin')==false)
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Género<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option {{$value->id == $usuario->idGenero ? 'selected' : ''}} value="{{$value->id}}">
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

                <div class="col-md-3 col-sm-12">
                    <label for="">Rol<strong style="color: red"> *</strong></label>
                    <select class="form-control" name="roles[]">
                        @foreach ($roles as $key => $value)
                        <option {{$value->id == $consulta?'selected':''}} value="{{$value->id}}">{{$value->name}}
                        </option>
                        @endforeach
                        @error('roles')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                @else
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Género<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="genero">
                            <option value="">Seleccione</option>
                            @foreach($generos as $key => $value)
                            <option {{$value->id == $usuario->idGenero ? 'selected' : ''}} value="{{$value->id}}">
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
                @endif
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $("#nombre, #apellido, #celular, #celularAlternativo").focusout(function(event) {
        console.log();
        if ($(this).val().length > 0) {
            $(this).addClass("is-valid").removeClass("is-valid");
            $(this).rules('remove');
        } else {
            $(this).valid();
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });
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
});

function ucfirst(str, force) {
    str = force ? str.toLocaleLowerCase() : str;
    return str.replace(/(\b)([a-zA-Z])/,
        function(firstLetter) {
            return firstLetter.toLocaleLowerCase();
        });
}

$('input[type="email"]').keyup(function(evt) {
    // force: true to lower case all letter except first 
    var cp_value = ucfirst($(this).val(), true);
    // to capitalize all words 
    //var cp_value= ucwords($(this).val(),true) ; 
    $(this).val(cp_value);
});
</script>

@endsection