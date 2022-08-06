@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar producto</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/producto/actualizar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$producto->id}}" />
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <!-- <img src="/imagenes/{{$producto->img}}" class="imagen" width='180px' height='150px'> -->
                        <img src="{{$producto->img=='/img/defecto.jpg'?"/img/defecto.jpg":"/imagenes/$producto->img"}}"
                            id="img-foto" class="imagen" width='200px' height='200px'>
                        {{-- <img src="" id="img-foto" class="rounded-circle mt-5" width="150"> --}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Imagen<b style="color: red"> *</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror"
                                name="img" id="imagen" onchange="vista_preliminar(event)">
                            <label class="custom-file-label" for="customFile">Subir foto del pastel</label>
                        </div>
                        @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Nombre<b style="color: red"> *</b></label>
                        <input value="{{$producto->nombre}}" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                            required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Categoría<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="categoria">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                            <option {{$value->id == $producto->idCategoria ? 'selected' : ''}}
                                {{old('categoria' ) == $value->id ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->nombre}}</option>
                            @endforeach
                            @error('categorias')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Sabor<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="sabor">
                            <option value="">Seleccione</option>
                            @foreach($sabores as $key => $value)
                            <option {{$value->id == $producto->idSabor ? 'selected' : ''}}
                                {{old('sabor' ) == $value->id ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->nombre}}</option>
                            @endforeach
                            @error('sabores')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Etapa<b style="color: red"> *</b></label>
                        <select class="form-control" name="etapa">
                            <option value="">Seleccione</option>
                            @foreach($etapas as $key => $value)
                            <option {{$value->id == $producto->idEtapa ? 'selected' : ''}}
                                {{old('etapa' ) == $value->id ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->nombre}}</option>
                            @endforeach
                            @error('etapas')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción<b style="color: red"> *</b></label>
                        <textarea value="{{$producto->descripcion}}" type="text"
                            class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                            name="descripcion" required>{{ucfirst($producto->descripcion) }}</textarea>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Número de personas<strong style="color: red"> *</strong></label>
                        <input value="{{$producto->numeroPersonas}}" type="number"
                            class="form-control @error('numeroPersonas') is-invalid @enderror" id="numeroPersonas"
                            name="numeroPersonas" required>
                        @error('numeroPersonas')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Pisos<strong style="color: red"> *</strong></label>
                        <input value="{{$producto->pisos}}" type="number"
                            class="form-control @error('pisos') is-invalid @enderror" id="pisos" name="pisos" required>
                        @error('pisos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Añadirlo al catálogo<strong style="color: red"> *</strong></label>
                        <select class="form-control" name="catalogo">
                            @if($producto->catalogo==1)
                            <option value="1" selected>Sí</option>
                            <option value="0">No</option>
                            @else
                            <option value="0" selected>No</option>
                            <option value="1">Sí</option>
                            @endif
                            @error('catalogo')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/producto" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let vista_preliminar = (event) => {
    let leer_img = new FileReader();
    let id_img = document.getElementById('img-foto');
    leer_img.onload = () => {
        if (leer_img.readyState == 2) {
            id_img.src = leer_img.result
        }
    }
    leer_img.readAsDataURL(event.target.files[0])
}
</script>
@endsection