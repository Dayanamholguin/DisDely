@extends('perfil.app')
@section('content-perfil')
<form id="form" action="/perfil/cambiarContrasena/{{$usuario->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row container">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Contraseña actual<b style="color: red" data-toggle="tooltip" data-placement="top"
                        title="Requerido"> *</b></label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    id="exampleInputPassword" placeholder="Ingrese contraseña actual" name="oldPassword" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Nueva contraseña<b style="color: red" data-toggle="tooltip" data-placement="top"
                        title="Requerido"> *</b></label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    id="exampleInputPassword" placeholder="Ingrese nueva contraseña" name="password" required
                    autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="">Confirmar nueva contraseña<b style="color: red" data-toggle="tooltip" data-placement="top"
                        title="Requerido"> *</b></label>
                <input id="password-confirm" type="password"
                    class="form-control form-control-user @error('password') is-invalid @enderror"
                    id="exampleRepeatPassword" placeholder="Confirme la nueva contraseña" name="password_confirmation"
                    required autocomplete="new-password">
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

@section('scripts')
<script>
$('#form').validate({
    rules: {
        oldPassword: {
            required: true
        },
        password: {
            required: true
        },
        password_confirmation: {
            required: true
        }
    }
});
</script>
@endsection