@extends('layouts.app')

@section('title')
Configuración
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Configurar página web</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/configuracion/actualizar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$principal->id}}" />
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <!-- <img src="/imagenesPrincipales/{{$principal->img}}" class="imagen" width='180px' height='150px'> -->
                        <img src="{{$principal->foto==null?"/img/defecto.jpg":"/imagenesPrincipales/$principal->foto"}}"
                            id="img-foto" class="imagen" width='200px' height='200px'>
                        {{-- <img src="" id="img-foto" class="rounded-circle mt-5" width="150"> --}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group centrado">
                        <!-- <img src="/imagenesPrincipales/{{$principal->img}}" class="imagen" width='180px' height='150px'> -->
                        <img src="{{$principal->foto2==null?"/img/defecto.jpg":"/imagenesPrincipales/$principal->foto2"}}"
                            id="img-foto2" class="imagen2" width='200px' height='200px'>
                        {{-- <img src="" id="img-foto" class="rounded-circle mt-5" width="150"> --}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Foto número 1<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror"
                                name="foto" id="imagen" onchange="vista_preliminar(event)">
                            <label class="custom-file-label" for="customFile">Subir foto 1</label>
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
                        <label for="">Foto número 2<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('imagen2') is-invalid @enderror"
                                name="foto2" id="imagen2" onchange="vista_preliminar2(event)">
                            <label class="custom-file-label" for="customFile">Subir foto 2</label>
                        </div>
                        @error('imagen2')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Texto de «¿Quiénes somos?»<b style="color: red" data-toggle="tooltip"
                                data-placement="top" title="Requerido"> *</b></label>
                        <textarea class="textarea-P form-control" name="quienes" id="quienes" cols="30"
                            rows="10">{{$principal->quienes}} </textarea>
                        @error('quienes')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Texto de «Nuestros productos»<b style="color: red" data-toggle="tooltip"
                                data-placement="top" title="Requerido"> *</b></label>
                        <textarea class="textarea-P form-control" name="productos" id="productos" cols="30"
                            rows="10">{{$principal->productos}}</textarea>
                        @error('productos')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Ubicación<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$principal->ubicacion}}" type="text"
                            class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion"
                            name="ubicacion" required>
                        @error('ubicacion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Email de la página web<b style="color: red" data-toggle="tooltip"
                                data-placement="top" title="Requerido"> *</b></label>
                        <input value="{{$principal->email}}" type="text"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="">Url de instagram<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$principal->instagram}}" type="text"
                            class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                            name="instagram" required>
                        @error('instagram')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="">Celular(es)<b style="color: red" data-toggle="tooltip" data-placement="top"
                            title="Requerido"> *</b></label>
                </div>
                <div class="col-md-6 col-sm-12 mt-3">
                    <input type="number" class="form-control" value="{{$principal->celular }}"
                        class="form-control @error('celular') is-invalid @enderror" name="celular" required
                        minlength="7" maxlength="10" placeholder="Ingrese su celular">
                    @error('celular')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-12 mt-3">
                    <input type="number" class="form-control" value="{{$principal->celular2 }}"
                        class="form-control @error('celular2') is-invalid @enderror" name="celular2" required
                        minlength="7" maxlength="10" placeholder="Ingrese su celular alternativo">
                    @error('celular2')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                    <button type="submit" class="btn btn-primary tipoletra">Editar configuración</button>
                    <a href="/configuracion/restablecer" class="btn btn-primary tipoletra">Restablecer datos
                        iniciales</a>
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
let vista_preliminar2 = (event) => {
    let leer_img = new FileReader();
    let id_img = document.getElementById('img-foto2');
    leer_img.onload = () => {
        if (leer_img.readyState == 2) {
            id_img.src = leer_img.result
        }
    }
    leer_img.readAsDataURL(event.target.files[0])
}
</script>
@endsection