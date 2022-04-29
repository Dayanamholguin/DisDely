@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')

<div class="container rounded bg-white mt-5">
  <div class="row">
    <div class="col-md-4 mb-3 border-right">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle mt-5" width="90">
          <div class="mt-3">
            <h4>{{ Auth::user()->nombre}}</h4>
            <!--<p class="text-secondary mb-1">Registrado(a) en nuestra plataforma {{Auth::user()->created_at->diffForHumans()}}</p>-->

            <p class="text-muted font-size-sm">Bienvenido(a) {{ Auth::user()->nombre}} a tu perfil</p>
            <button type="submit" class="btn btn-primary">Cambiar foto</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <hr>
      <div class="centrado" style="background-color: #E6CAA5; color:white;">Editar Perfil</div>
      <hr>
      <div class="p-3 py-5">
          <div class="col-sm-5">
            <h6 class="mb-0">Nombre Completo<b style="color:red;">*</b></h6>
          </div>
          <div class="row mt-2">
            <div class="col-md-6"><input type="text" class="form-control" value="{{Auth::user()->nombre }}" class="form-control @error('nombre') is-invalid @enderror" required></div>
            <div class="col-md-6"><input type="text" class="form-control" value="{{Auth::user()->apellido }}" class="form-control @error('apellido') is-invalid @enderror" required></div>
          </div>
          <hr>
          <div class="col-sm-6">
            <h6 class="mb-0">Celular y/o Teléfono<b style="color:red;">*</b></h6>
          </div>
          <div class="row mt-3">
            <div class="col-md-6"><input type="text" class="form-control" value="{{Auth::user()->celular }}" class="form-control @error('celular') is-invalid @enderror" required></div>
            <div class="col-md-6"><input type="text" class="form-control" value="{{Auth::user()->celularAlternativo }}" class="form-control @error('celularAlternativo') is-invalid @enderror" required></div>
          </div>
          <hr>
          <div class="col-sm-5">
            <h6 class="mb-0">Correo Electrónico<b style="color:red;">*</b></h6>
          </div>
          <div class="row mt-3">
            <div class="col-md-6"><input type="text" readonly="readonly" class="form-control" value="{{Auth::user()->email }}"></div>
          </div>
          <hr>
          <div class="mt-5 centrado text-right"><button class="btn btn-primary" type="submit">Guardar cambios</button></div>
        </div>
    </div>
  </div>
</div>
@endsection