@extends('perfil.app')
@section('content-perfil')
<form id="form" action="/perfil/cambiarContrasena/{{$usuario->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row container">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Contraseña actual<strong style="color:red;">*</strong></label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Ingrese contraseña actual" name="oldPassword" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Nueva contraseña<strong style="color:red;">*</strong></label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Ingrese nueva contraseña" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Confirmar nueva contraseña<strong style="color:red;">*</strong></label>
                <input id="password-confirm" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Confirme la nueva contraseña" name="password_confirmation" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12 centrado">
            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
        </div>
    </div>
</form>
@endsection