@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header text-center">Bienvenido(a), {{ Auth::user()->nombre}}</div>
                @include('flash::message')
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p class="text-center">Dulce Encanto te da una gran bienvenida, recuerda <strong>hacemos pasteles para toda ocasión</strong></p>
                </div>
                {{-- <img class="img-profile rounded-circle" src="/../img/{{Auth::user()->foto}}"> --}}
                
            </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cómo usar el aplicativo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mb-2">
          <p>Hola, {{ Auth::user()->nombre}}.
            <br>Estamos muy feliz porque nos has elegido para realizar tus cotizaciones y pedidos.</p>
            <a href="" class="alert-link titulo">Clic aquí para saber usar el aplicativo</a>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
<div class="fixed" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;">
    <img src="/../imagenesPrincipales/icono.png" alt="" width="200px" height="250px" srcset="" data-toggle="tooltip" data-placement="top" title="Clic aquí para saber cómo utilizar el aplicativo">
</div>
@endsection


