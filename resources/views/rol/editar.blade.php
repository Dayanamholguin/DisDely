@extends('layouts.app')

@section('title')
Roles
@endsection

@section('content')
<div class="card">      
    <div class="card-header text-center">
        <strong>Editar Rol</strong> / <a href="/rol" class="alert-link titulo">Volver</a>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/rol/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$rol->id}}" />
            <div class="container mt-1">
                <div class="row ">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre<b style="color: red"> *</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$rol->name}}" required>
                            
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <h5>Lista de permisos<b style="color: red"> *</b></h5>
                            @foreach ($permisos as $value)
                                <div>
                                    <label>
                                        <input type="checkbox"
                                        @foreach($rolPermisos as $rolPermiso)
                                            @if ($value->id == $rolPermiso->permission_id)
                                                {{'checked'}}
                                            @endif 
                                        @endforeach
                                         name="permisos[]" value="{{$value->id}}" id=""  class="mr-1 ">
                                            {{$value->description}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
 