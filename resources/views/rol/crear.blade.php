@extends('layouts.app')

@section('title')
Roles
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Rol</strong> 
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/rol/guardar" method="post">
            @csrf
            <div class="container mt-1">
                <div class="row ">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="name">Nombre<strong style="color: red"> *</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{old('name')}}" id="name" name="name" placeholder="Ingrese nombre del rol"
                                required pattern="[a-zA-Z]+">
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group ">
                            <h5>Lista de permisos<strong style="color: red"> *</strong></h5>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-4">
                                        <label> 
                                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                                class="mr-1">
                                            {{$permission->description}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                            <a href="/rol" class="btn btn-primary tipoletra">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function() {
    $("#name").focusout(function(event) {
        console.log();
        if($(this).val().length > 0){
            // $(this).addClass("is-valid").removeClass("is-invalid");
            $(this).rules('remove');
        } 
        else {
            $(this).valid();
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });
    $('#form').validate({
        rules: {
            name: {
                mouseout: true,
                required: true,
            }
        },
    });
});
</script>
@endsection