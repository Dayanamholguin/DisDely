@extends('layouts.app')

@section('title')
Cotización
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Registro de cotización</strong> / <a href="/producto/catalogo" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="#" method="post">
            @csrf
            <input type="hidden" name="producto" value="{{$producto->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Producto<b style="color: red"> *</b></label>
                        <input type="text" readonly value="{{$producto->nombre}}"
                            class="form-control @error('producto') is-invalid @enderror" id="producto" name="producto"
                            required>
                        @error('producto')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor deseado<b style="color: red"> *</b></label>
                        <input type="text" value="{{ old('saborDeseado') }}"
                            class="form-control @error('saborDeseado') is-invalid @enderror" id="saborDeseado"
                            name="saborDeseado" placeholder="Ingrese el sabor deseado" required>
                        @error('saborDeseado')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">¿Para cuántas personas?<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('numeroPersonas') }}"
                            class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas"
                            name="numeroPersonas" placeholder="Ingrese número de personas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Frase si desea</label>
                        <input type="TEXT" value="{{ old('frase') }}"
                            class="form-control @error('frase') is-invalid @enderror" id="frase" name="frase"
                            placeholder="Ingrese frase que desea en el pastel" required>
                        @error('frase')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<b style="color: red"> *</b></label>
                        <input type="number" value="{{ old('pisos') }}"
                            class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos"
                            placeholder="Ingrese número de pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<b style="color: red"> *</b></label>
                        <textarea type="text" value="{{ old('descripcionProducto') }}"
                            class="form-control @error('descripcionProducto') is-invalid @enderror" id="descripcionProducto"
                            name="descripcionProducto" placeholder="Ingrese la descripción"
                            required>{{ old('descripcionProducto') }}</textarea>
                        @error('descripcionProducto')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection