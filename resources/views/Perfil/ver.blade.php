@extends('perfil.app')
@section('content-perfil')
<form id="form" action="/perfil/actualizar/{{$usuario->id}}" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$usuario->id}}" />
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <h6 class="mb-0">Nombre Completo<strong style="color:red;">*</strong></h6>
    </div>
    <div class="col-md-6 col-sm-12 mt-3">
      <input type="text" class="form-control" value="{{$usuario->nombre }}" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required" placeholder="Ingrese su nombre">
      @error('nombre')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="col-md-6 col-sm-12 mt-3">
      <input type="text" class="form-control" value="{{$usuario->apellido }}" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" required" placeholder="Ingrese su apellido">
      @error('apellido')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
    </div>

    <hr>
    <div class="col-md-12 col-sm-12 mt-3 mb-3">
      <h6 class="mb-0">Correo Electrónico<strong style="color:red;">*</strong></h6>
    </div>
    <div class="col-md-12 col-sm-12 ">
      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{$usuario->email }}" placeholder="Ingrese su email">
      @error('email')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
    </div>
    <hr>
    <div class="col-md-12 col-sm-12 mt-3">
      <h6 class="mb-0">Celular y/o Teléfono<strong style="color:red;">*</strong></h6>
    </div>
    <div class="col-md-6 col-sm-12 mt-3">
      <input type="text" class="form-control" value="{{$usuario->celular }}" class="form-control @error('celular') is-invalid @enderror" name="celular" required minlength="7" maxlength="10" placeholder="Ingrese su celular">
      @error('celular')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="col-md-6 col-sm-12 mt-3">
      <input type="text" class="form-control" value="{{$usuario->celularAlternativo }}" class="form-control @error('celularAlternativo') is-invalid @enderror" name="celularAlternativo" required minlength="7" maxlength="10" placeholder="Ingrese su celular alternativo">
      @error('celularAlternativo')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="col-md-12 col-sm-12 mt-3">
      <h6 class="mb-0">Género<strong style="color:red;">*</strong></h6>
    </div>
    <div class="col-md-12 col-sm-12 mt-3">
      <select class="form-control" style="width: 100%" name="genero">
        <option value="">Seleccione</option>
        @if ($usuario->idGenero==2)
        <option value="2" selected>Masculino</option>
        <option value="3">Femenino</option>
        @else
        <option value="2">Masculino</option>
        <option value="3" selected>Femenino</option>
        @endif
      </select>
    </div>
    <hr>
    <div class="col-md-12 col-sm-12 mt-4 centrado text-right">
      <button class="btn btn-primary" type="submit">Guardar cambios</button>
    </div>
  </div>
</form>
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
            var pattern = /^[A-Za-z0-9áéíóúüÜÑñ\s]+$/g;
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
</script>

@endsection