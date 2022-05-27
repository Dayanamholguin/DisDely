@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')

<div class="container rounded bg-white  ">
  <div class="row">
    <div class="col-md-4 border-right">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          {{-- <img src="/imagenes/{{Auth::user()->foto}}" alt="Admin" class="rounded-circle mt-5" width="90">
           --}}
           <img src="/../img/{{Auth::user()->foto}}" alt="Admin" class="rounded-circle mt-5" width="90">
            <div class="mt-3">
            <h4>{{ $usuario->nombre}}</h4>
            <!--<p class="text-secondary mb-1">Registrado(a) en nuestra plataforma {{$usuario->created_at->diffForHumans()}}</p>-->

            <p class="text-muted font-size-sm">Bienvenido(a) {{ $usuario->nombre}} a tu perfil</p>
            <a type="submit" href="/perfil/cambiarFoto/{{Auth::user()->id}}" class="btn btn-primary">Cambiar foto</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 mb-3">
      <hr>
      <div class="centrado">
        <strong>Perfil</strong>
      </div>
      <div class="container mt-1 mb-1 text-center">
        <div class="row justify-content-center">
            <div class="col-auto">
                @include('flash::message')
            </div>
        </div>
      </div>
      <hr>
      @yield('content-perfil')
    </div>
  </div>
</div>
@endsection
