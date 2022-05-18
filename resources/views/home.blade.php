@extends('layouts.app')

@section('content')
<style>
    .tipoletra {
        font-family: 'Montserrat', sans-serif !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Bienvenido(a), {{ Auth::user()->nombre}}</div>

                <div class="card-body">
                    <div class="container mt-1 mb-1">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                @include('flash::message')
                            </div>
                        </div>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p class="text-center">Dulce Encanto te da una gran bienvenida, recuerda <strong>hacemos pasteles para toda ocasión</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection