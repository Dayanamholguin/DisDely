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
<div class="fixed">
    <img src="/../imagenesPrincipales/icono.png" alt="" width="200px" height="250px" srcset="" data-toggle="tooltip" data-placement="top" title="Hola, estamos muy feliz porque nos has elegido para realizar tus cotizaciones y pedidos. Clic aquí para saber cómo utilizar el aplicativo">
</div>
@endsection

